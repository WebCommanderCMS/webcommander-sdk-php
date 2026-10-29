<?php

declare(strict_types=1);

namespace WebCommander\Http;

use WebCommander\Errors\SdkUsageError;
use WebCommander\Redaction;

final class UrlBuilder
{
    private const PLACEHOLDER = '/\{([a-z_][a-z0-9_]*)\}/';
    private const ABSOLUTE_PREFIXES = ['http://', 'https://'];
    public const IMPLIED_PORTS = ['http' => 80, 'https' => 443];

    /** @return list<string> */
    public static function findPathParamNames(string $template): array
    {
        [$body] = self::splitTemplate($template);
        preg_match_all(self::PLACEHOLDER, $body, $matches);
        $seen = [];
        foreach ($matches[1] as $name) {
            $seen[$name] = true;
        }
        return array_keys($seen);
    }

    public static function rejectFragment(string $field, string $value): void
    {
        if (!str_contains($value, '#')) {
            return;
        }
        throw new SdkUsageError("{$field}: carries a #fragment, which is never sent; strip it");
    }

    /** @param array<string,mixed>|null $pathParams */
    public static function substitutePathParams(string $template, ?array $pathParams = null): string
    {
        self::rejectFragment('path', $template);
        [$body, $queryAndFragment] = self::splitTemplate($template);
        $expected = self::findPathParamNames($template);
        $supplied = $pathParams ?? [];

        $problems = [];
        $missing = array_values(array_filter($expected, static fn ($n) => !array_key_exists($n, $supplied)));
        if ($missing) {
            sort($missing);
            $problems[] = 'missing path params: ' . implode(', ', $missing);
        }
        $unknown = array_values(array_filter(array_keys($supplied), static fn ($n) => !in_array($n, $expected, true)));
        if ($unknown) {
            sort($unknown);
            $problems[] = 'unknown path params: ' . implode(', ', $unknown);
        }
        $given = array_values(array_filter($expected, static fn ($n) => array_key_exists($n, $supplied)));
        $blank = array_values(array_filter($given, static fn ($n) => self::isBlank($supplied[$n])));
        if ($blank) {
            sort($blank);
            $problems[] = 'blank path params: ' . implode(', ', $blank);
        }
        $wrong = [];
        $wrongTyped = [];
        foreach ($given as $name) {
            if (!in_array($name, $blank, true) && !self::isUsable($supplied[$name])) {
                $wrong[] = $name;
                $wrongTyped[] = $name . ' (' . get_debug_type($supplied[$name]) . ')';
            }
        }
        if ($wrongTyped) {
            sort($wrongTyped);
            $problems[] = 'wrong-typed path params: ' . implode(', ', $wrongTyped);
        }
        $dotOnly = [];
        foreach ($given as $name) {
            if (!in_array($name, $blank, true)
                && !in_array($name, $wrong, true)
                && self::isDotOnly(self::paramText($supplied[$name]))) {
                $dotOnly[] = $name;
            }
        }
        if ($dotOnly) {
            sort($dotOnly);
            $problems[] = 'dot-only path params: ' . implode(', ', $dotOnly)
                . ' - a value of only dots resolves to a different endpoint, so it is refused'
                . ' rather than sent';
        }
        if ($problems) {
            throw new SdkUsageError("{$template} -> " . implode('; ', $problems));
        }

        $substituted = preg_replace_callback(
            self::PLACEHOLDER,
            static fn (array $m): string => rawurlencode(self::paramText($supplied[$m[1]])),
            $body
        );
        if ($substituted === null || str_contains($substituted, '{') || str_contains($substituted, '}')) {
            throw new SdkUsageError("{$template} -> malformed placeholder: a brace outside a {name} placeholder");
        }
        return $substituted . $queryAndFragment;
    }

    public static function buildUrl(string $baseUrl, string $path): string
    {
        self::rejectRedactedValue($path);
        $lower = strtolower($path);
        foreach (self::ABSOLUTE_PREFIXES as $prefix) {
            if (str_starts_with($lower, $prefix)) {
                self::requireSameOrigin($baseUrl, $path);
                return $path;
            }
        }
        return rtrim($baseUrl, '/') . (str_starts_with($path, '/') ? '' : '/') . $path;
    }

    private static function rejectRedactedValue(string $path): void
    {
        $pattern = '#[?\#&]([^?\#&=]*)=' . preg_quote(Redaction::REDACTED, '#') . '(?=[&\#]|$)#';
        if (preg_match($pattern, $path, $m) === 1) {
            throw new SdkUsageError(
                "path: parameter '{$m[1]}' holds the redaction marker '" . Redaction::REDACTED
                . "'; this URL is a printed copy, so read Location off the response itself"
            );
        }
    }

    /** A refusal here names an **origin** and never a resolved path. */
    private static function requireSameOrigin(string $baseUrl, string $url): void
    {
        $parts = parse_url($url);
        if ($parts === false) {
            throw new SdkUsageError('path: an absolute URL was passed that is not a usable URL');
        }
        if (isset($parts['user']) || isset($parts['pass'])) {
            $host = $parts['host'] ?? '';
            throw new SdkUsageError(
                "absolute URL for host {$host} carries embedded credentials, which would "
                . 'replace the bearer token; strip the userinfo before following it'
            );
        }
        if (self::splitOrigin($url) !== self::splitOrigin($baseUrl)) {
            throw new SdkUsageError(
                'absolute URL for origin ' . self::renderOrigin($url) . ' is not on the configured '
                . 'origin ' . self::renderOrigin($baseUrl) . '; an absolute URL is requested with '
                . "the access token attached, so only the store's own links may be passed back"
            );
        }
    }

    /** scheme://host[:port], and no more of the URL than that. */
    private static function renderOrigin(string $url): string
    {
        [$scheme, $host, $port] = self::splitOrigin($url);
        $implied = self::IMPLIED_PORTS[$scheme] ?? 0;
        return $scheme . '://' . $host . ($port === $implied ? '' : ':' . $port);
    }

    /** @return array{string,string,int} */
    private static function splitOrigin(string $url): array
    {
        $parts = parse_url($url);
        if ($parts === false) {
            throw new SdkUsageError('url: unusable URL - the origin could not be read from it');
        }
        $scheme = strtolower($parts['scheme'] ?? '');
        $host = strtolower($parts['host'] ?? '');
        $port = $parts['port'] ?? (self::IMPLIED_PORTS[$scheme] ?? 0);
        return [$scheme, $host, $port];
    }

    /** @return array{string,string} */
    private static function splitTemplate(string $template): array
    {
        if (preg_match('/[?\#]/', $template, $m, PREG_OFFSET_CAPTURE) === 1) {
            $at = $m[0][1];
            return [substr($template, 0, $at), substr($template, $at)];
        }
        return [$template, ''];
    }

    private static function paramText(mixed $value): string
    {
        return is_string($value) ? trim($value) : (string) $value;
    }

    private static function isDotOnly(string $text): bool
    {
        return $text !== '' && trim($text, '.') === '';
    }

    private static function isBlank(mixed $value): bool
    {
        return $value === null || (is_string($value) && trim($value) === '');
    }

    private static function isUsable(mixed $value): bool
    {
        return is_string($value) || is_int($value);
    }
}
