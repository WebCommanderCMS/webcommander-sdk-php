<?php

declare(strict_types=1);

namespace WebCommander\Client;

use WebCommander\Config\SdkConfig;
use WebCommander\Http\Transport;
use WebCommander\Redaction;

final class Console
{
    private const MULTIPART_PREFIX = '<multipart: ';
    private const PAYLOAD_FILES_KEY = 'files';
    private const PAYLOAD_FORM_KEY = 'form';
    private const CONTENT_TYPE_HEADER = 'Content-Type';
    private const JSON_CONTENT_TYPE = 'application/json';

    public static function renderJsonValue(mixed $value, bool $compact = false): string
    {
        if ($value === null) {
            return '<empty>';
        }
        if (is_string($value)) {
            if (!mb_check_encoding($value, 'UTF-8')) {
                return '<' . strlen($value) . ' bytes>';
            }
            if ($compact) {
                // Collapsed, not re-encoded, or `--data-raw` below carries a string literal.
                $document = self::jsonDocumentOneLine($value);
                if ($document !== null) {
                    return self::neutralise($document);
                }
                $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                return self::neutralise(substr((string) $json, 1, -1));
            }
            $pretty = self::prettyJson($value);
            return self::neutralise($pretty ?? $value, true);
        }
        if (is_scalar($value)) {
            return self::neutralise(self::safeText($value));
        }
        $flags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | ($compact ? 0 : JSON_PRETTY_PRINT);
        $rendered = json_encode($value, $flags);
        if ($rendered === false) {
            return self::neutralise(self::safeText($value), true);
        }
        return self::neutralise($rendered, !$compact);
    }

    /** Read once and detached from the caller's live objects, which may change later.
     *  @return list<array{string,array{string,string}}> */
    public static function freezeMultipartLabels(#[\SensitiveParameter] mixed $files): array
    {
        $frozen = [];
        foreach (self::multipartEntries($files) as [$fieldName, $label]) {
            $frozen[] = [$fieldName, [$label, '']];
        }
        return $frozen;
    }

    public static function summarisePayload(mixed $body, mixed $files): mixed
    {
        $entries = self::multipartEntries($files);
        if ($entries === []) {
            return $body;
        }
        $names = implode(', ', array_map(static fn (array $e): string => "{$e[0]}={$e[1]}", $entries));
        $summary = self::MULTIPART_PREFIX . $names . '>';
        if ($body === null) {
            return $summary;
        }
        return [self::PAYLOAD_FILES_KEY => $summary, self::PAYLOAD_FORM_KEY => $body];
    }

    public static function renderExchange(object $response, mixed $body, mixed $files, SdkConfig $config, bool $formEncoded = false): string
    {
        $info = $response->requestInfo;
        $payload = self::summarisePayload($body, $files);

        if ($config->printFormat === SdkConfig::PRINT_FORMAT_COMPACT) {
            $parts = [
                'wc', $info->clientName, $info->httpMethod, $info->url,
                (string) $response->statusCode,
                "{$info->attemptCount}/{$info->maxAttempts}",
                "{$info->elapsedSeconds}s",
            ];
            if ($config->printRequestPayload) {
                $parts[] = 'payload=' . self::renderJsonValue(Redaction::redactValue($payload), true);
            }
            if ($config->printResponseBody) {
                // `map`, never `data`: the block shows the body the store sent.
                $parts[] = 'response=' . self::renderJsonValue(Redaction::redactValue($response->map), true);
            }
            return self::truncate(implode(' | ', $parts), $config->printMaxChars);
        }

        $colour = self::colourEnabled($config);
        $lines = [self::dim('┌─ WebCommander ' . str_repeat('─', 46), $colour)];
        if ($config->printApiInfo) {
            foreach ([
                'client' => $info->clientName,
                'api version' => $info->apiVersion,
                'method' => $info->httpMethod,
                'endpoint' => $info->url,
                'params' => self::renderJsonValue($info->queryParams, true),
            ] as $label => $value) {
                $lines[] = '│ ' . str_pad((string) $label, 12) . ' : ' . self::neutralise(self::safeText($value));
            }
            $lines[] = '│ ' . str_pad('status', 12) . ' : '
                . self::status((string) $response->statusCode, $response->succeeded(), $colour);
            $lines[] = '│ ' . str_pad('attempt', 12) . " : {$info->attemptCount} / {$info->maxAttempts}";
            $lines[] = '│ ' . str_pad('elapsed', 12) . " : {$info->elapsedSeconds}s";
        }
        if ($config->printHeaders) {
            $lines[] = self::dim('├─ request headers ' . str_repeat('─', 43), $colour);
            foreach ($info->headers as $name => $value) {
                $lines[] = '│ ' . self::neutralise(self::safeText($name)) . ': ' . self::neutralise(self::safeText($value));
            }
            $lines[] = self::dim('├─ response headers ' . str_repeat('─', 42), $colour);
            foreach (Redaction::redactMapping($response->headers) as $name => $value) {
                $lines[] = '│ ' . self::neutralise(self::safeText($name)) . ': ' . self::neutralise(self::safeText($value));
            }
        }
        if ($config->printRequestPayload && $payload !== null) {
            $lines[] = self::dim('├─ payload ' . str_repeat('─', 51), $colour);
            foreach (explode("\n", self::renderJsonValue(Redaction::redactValue($payload))) as $line) {
                $lines[] = '│ ' . $line;
            }
        }
        if ($config->printResponseBody) {
            $lines[] = self::dim('├─ response ' . str_repeat('─', 50), $colour);
            foreach (explode("\n", self::renderJsonValue(Redaction::redactValue($response->map))) as $line) {
                $lines[] = '│ ' . $line;
            }
        }
        if ($config->printCurl) {
            $lines[] = self::dim('├─ curl (POSIX shell) ' . str_repeat('─', 40), $colour);
            foreach (explode("\n", self::buildCurlCommand($response, $payload, $files, $config, $formEncoded)) as $line) {
                $lines[] = '│ ' . $line;
            }
        }
        $lines[] = self::dim('└' . str_repeat('─', 61), $colour);
        return self::truncate(implode("\n", $lines), $config->printMaxChars);
    }

    public static function buildCurlCommand(object $response, mixed $payload, mixed $files, SdkConfig $config, bool $formEncoded = false): string
    {
        $info = $response->requestInfo;
        $url = self::neutralise(self::safeText($info->url));
        if ($info->queryParams !== []) {
            $separator = str_contains($url, '?') ? '&' : '?';
            // `***` kept readable rather than %2A%2A%2A
            $url .= $separator . str_replace('%2A', '*', Transport::encodeQuery($info->queryParams));
        }

        $parts = ['curl -X ' . self::posixQuote($info->httpMethod) . ' ' . self::posixQuote($url)];
        if (!$config->verifySsl) {
            $parts[] = '  -k';
        }
        $headers = $info->headers;
        ksort($headers);
        foreach ($headers as $name => $value) {
            $header = self::neutralise(self::safeText($name)) . ': ' . self::neutralise(self::safeText($value));
            $parts[] = '  -H ' . self::posixQuote($header);
        }

        $entries = self::multipartEntries($files);
        $formBody = self::formPart($payload);
        foreach ($entries as [$field, $filename]) {
            $parts[] = '  -F ' . self::posixQuote(self::neutralise($field) . '=@' . self::neutralise($filename));
        }
        if ($entries !== []) {
            foreach (self::formFields($formBody) as [$key, $value]) {
                $parts[] = '  -F ' . self::posixQuote(self::neutralise(self::safeText($key)) . '=' . self::neutralise(self::safeText($value)));
            }
        } elseif ($formBody !== null) {
            $fields = $formEncoded ? self::formFields($formBody) : [];
            if ($fields !== []) {
                foreach ($fields as [$key, $value]) {
                    $parts[] = '  --data-urlencode ' . self::posixQuote(self::neutralise(self::safeText($key)) . '=' . self::neutralise(self::safeText($value)));
                }
            } else {
                $rendered = self::renderJsonValue(Redaction::redactValue($formBody), true);
                if (!$formEncoded && !self::namesContentType($info->headers)) {
                    $parts[] = '  -H ' . self::posixQuote(self::CONTENT_TYPE_HEADER . ': ' . self::JSON_CONTENT_TYPE);
                }
                $parts[] = '  --data-raw ' . self::posixQuote($rendered);
            }
        }
        return implode(" \\\n", $parts);
    }

    /** @return list<array{string,string}> */
    private static function multipartEntries(mixed $files): array
    {
        if (is_array($files)) {
            if (array_is_list($files) && $files !== []
                && array_reduce($files, static fn ($c, $e) => $c && is_array($e) && count($e) === 2, true)) {
                return array_map(static fn (array $e): array => self::multipartEntry((string) array_values($e)[0], array_values($e)[1]), $files);
            }
            $out = [];
            foreach ($files as $key => $value) {
                $out[] = self::multipartEntry((string) $key, $value);
            }
            return $out;
        }
        if (is_object($files) && method_exists($files, 'read')) {
            return [self::multipartEntry('file', $files)];
        }
        return [];
    }

    /** @return array{string,string} */
    private static function multipartEntry(string $fieldName, mixed $value): array
    {
        $filename = null;
        $handle = $value;
        if (is_array($value) && $value !== []) {
            $values = array_values($value);
            if (is_string($values[0])) {
                $filename = $values[0];
            }
            $handle = $values[1] ?? null;
        }
        $name = $filename
            ?? (is_object($handle) && property_exists($handle, 'filename') ? $handle->filename : null)
            ?? 'file';
        return [$fieldName, (string) $name];
    }

    private static function formPart(mixed $payload): mixed
    {
        if (is_array($payload)
            && array_keys($payload) === [self::PAYLOAD_FILES_KEY, self::PAYLOAD_FORM_KEY]
            && is_string($payload[self::PAYLOAD_FILES_KEY])
            && str_starts_with($payload[self::PAYLOAD_FILES_KEY], self::MULTIPART_PREFIX)) {
            return $payload[self::PAYLOAD_FORM_KEY];
        }
        return $payload;
    }

    /** @return list<array{mixed,mixed}> */
    private static function formFields(mixed $body): array
    {
        if (is_array($body) && !array_is_list($body)) {
            $redacted = Redaction::redactValue($body);
            $out = [];
            foreach ($redacted as $key => $value) {
                $out[] = [$key, $value];
            }
            return $out;
        }
        if (is_array($body) && array_is_list($body)
            && array_reduce($body, static fn ($c, $e) => $c && is_array($e) && count($e) === 2, true)) {
            $redacted = Redaction::redactValue($body);
            return array_map(static fn (array $e): array => [array_values($e)[0], array_values($e)[1]], $redacted);
        }
        return [];
    }

    /** @param array<string,mixed> $headers */
    private static function namesContentType(array $headers): bool
    {
        foreach ($headers as $name => $_) {
            if (strcasecmp(self::safeText($name), self::CONTENT_TYPE_HEADER) === 0) {
                return true;
            }
        }
        return false;
    }

    private static function prettyJson(string $text): ?string
    {
        $decoded = self::decodeJsonDocument($text);
        if ($decoded === null) {
            return null;
        }
        $pretty = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $pretty === false ? null : $pretty;
    }

    /** JSON text with line breaks removed. */
    private static function jsonDocumentOneLine(string $text): ?string
    {
        if (self::decodeJsonDocument($text) === null) {
            return null;
        }
        // Anchored on the newline: a leading `\s*` backtracks across a long run.
        return preg_replace('/[\n\r\t]\s*/', '', $text) ?? $text;
    }

    /** Null when the text is not a JSON object or array; a bare `42` is not one. */
    public static function decodeJsonDocument(string $text): ?array
    {
        $trimmed = ltrim($text);
        if ($trimmed === '' || ($trimmed[0] !== '{' && $trimmed[0] !== '[')) {
            return null;
        }
        $decoded = json_decode($text, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            return null;
        }
        return $decoded;
    }

    private static function posixQuote(string $value): string
    {
        return "'" . str_replace("'", "'\\''", $value) . "'";
    }

    /** Forced off by NO_COLOR and TERM=dumb, neither of which isatty() knows about. */
    private static function colourEnabled(SdkConfig $config): bool
    {
        if (!$config->printColor) {
            return false;
        }
        if (getenv('NO_COLOR') !== false && getenv('NO_COLOR') !== '') {
            return false;
        }
        if (getenv('TERM') === 'dumb') {
            return false;
        }
        return defined('STDOUT') && stream_isatty(STDOUT);
    }

    private static function dim(string $text, bool $enabled): string
    {
        return $enabled ? "\x1b[2m{$text}\x1b[0m" : $text;
    }

    private static function status(string $text, bool $succeeded, bool $enabled): string
    {
        if (!$enabled) {
            return $text;
        }
        return "\x1b[" . ($succeeded ? '32' : '31') . "m{$text}\x1b[0m";
    }

    public static function neutralise(string $text, bool $keepNewlines = false): string
    {
        $pattern = $keepNewlines
            ? '/[\x{0}-\x{9}\x{b}-\x{1f}\x{7f}-\x{9f}\x{2028}\x{2029}]/u'
            : '/[\x{0}-\x{1f}\x{7f}-\x{9f}\x{2028}\x{2029}]/u';
        return preg_replace_callback(
            $pattern,
            static function (array $m): string {
                $cp = mb_ord($m[0], 'UTF-8');
                return $cp !== false && $cp <= 0xff ? sprintf('\\x%02x', $cp) : sprintf('\\u%04x', (int) $cp);
            },
            $text
        ) ?? $text;
    }

    public static function safeText(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        }
        if ($value === null) {
            return '';
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_scalar($value)) {
            return (string) $value;
        }
        $encoded = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $encoded !== false ? $encoded : '<' . get_debug_type($value) . '>';
    }

    private static function truncate(string $text, int $maxChars): string
    {
        if ($maxChars <= 0 || mb_strlen($text) <= $maxChars) {
            return $text;
        }
        $cut = mb_substr($text, 0, max(0, $maxChars - 20));
        // Close any open colour run, or a cut inside one leaves the terminal dim.
        if (str_contains($cut, "\x1b")) {
            $cut .= "\x1b[0m";
        }
        return $cut . '… +' . (mb_strlen($text) - mb_strlen($cut)) . ' chars';
    }
}
