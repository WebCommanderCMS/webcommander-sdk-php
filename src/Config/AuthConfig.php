<?php

declare(strict_types=1);

namespace WebCommander\Config;

use WebCommander\Auth\TokenCache;
use WebCommander\Errors\SdkConfigError;
use WebCommander\Redaction;

/** Auth for one WebCommander instance, plus where the token is cached. */
final class AuthConfig
{
    /** Sentinel for "resolve the platform per-user cache path". Also the field default. */
    public const USE_DEFAULT_TOKEN_CACHE = "\0__WC_USE_DEFAULT_TOKEN_CACHE__\0";

    public readonly string $baseUrl;
    public readonly ?string $tokenCachePath;

    /** @var list<string> */
    public const FIELDS = ['baseUrl', 'clientId', 'clientSecret', 'redirectUri', 'authString', 'clientName', 'grantType', 'tokenCachePath'];

    /** @var list<string> */
    public const REQUIRED_FIELDS = [
        'baseUrl',
        'clientId',
        'clientSecret',
        'redirectUri',
        'authString',
        'clientName',
        'grantType',
    ];

    public function __construct(
        string $baseUrl,
        public readonly string $clientId,
        #[\SensitiveParameter] public readonly string $clientSecret,
        public readonly string $redirectUri,
        #[\SensitiveParameter] public readonly string $authString,
        public readonly string $clientName,
        public readonly string $grantType,
        ?string $tokenCachePath = self::USE_DEFAULT_TOKEN_CACHE,
    ) {
        $this->baseUrl = rtrim(trim($baseUrl), '/');

        $this->validate($tokenCachePath);

        $this->tokenCachePath = $tokenCachePath === self::USE_DEFAULT_TOKEN_CACHE
            ? TokenCache::defaultPath()
            : $tokenCachePath;
    }

    /** Derive a new set of credentials from this one.
     *  @param array<string,mixed> $changes */
    public function withOverrides(array $changes): self
    {
        $unknown = array_diff(array_keys($changes), self::FIELDS);
        if ($unknown !== []) {
            throw new SdkConfigError('unknown auth field(s): ' . implode(', ', $unknown));
        }
        return new self(
            baseUrl: $changes['baseUrl'] ?? $this->baseUrl,
            clientId: $changes['clientId'] ?? $this->clientId,
            clientSecret: $changes['clientSecret'] ?? $this->clientSecret,
            redirectUri: $changes['redirectUri'] ?? $this->redirectUri,
            authString: $changes['authString'] ?? $this->authString,
            clientName: $changes['clientName'] ?? $this->clientName,
            grantType: $changes['grantType'] ?? $this->grantType,
            tokenCachePath: array_key_exists('tokenCachePath', $changes) ? $changes['tokenCachePath'] : $this->tokenCachePath,
        );
    }

    private function validate(?string $tokenCachePath): void
    {
        $problems = [];

        $missing = [];
        foreach (self::REQUIRED_FIELDS as $name) {
            if (trim($this->$name) === '') {
                $missing[] = $name;
            }
        }
        if ($missing !== []) {
            $problems[] = 'missing required values: ' . implode(', ', $missing);
        }

        if ($this->baseUrl !== '') {
            foreach ($this->problemsWithBaseUrl($this->baseUrl) as $problem) {
                $problems[] = $problem;
            }
        }

        if ($tokenCachePath !== self::USE_DEFAULT_TOKEN_CACHE && $tokenCachePath !== null) {
            if (trim($tokenCachePath) === '') {
                $problems[] = 'tokenCachePath: must not be blank - pass null to keep the token in '
                    . 'memory, or a path to cache it';
            } elseif (is_dir($tokenCachePath)) {
                $problems[] = "tokenCachePath: '{$tokenCachePath}' is an existing directory, so "
                    . 'nothing could be written to it - pass the file to write, or null to keep the '
                    . 'token in memory';
            }
        }

        if ($problems !== []) {
            $label = $this->clientName !== '' ? $this->clientName : '<unnamed>';
            throw new SdkConfigError("instance {$label}: " . implode('; ', $problems));
        }
    }

    /** @return list<string> */
    private function problemsWithBaseUrl(string $baseUrl): array
    {
        $parts = parse_url($baseUrl);
        if ($parts === false) {
            return ['baseUrl: is not a URL'];
        }
        $scheme = $parts['scheme'] ?? '';
        if ($scheme !== 'http' && $scheme !== 'https') {
            return ['baseUrl: must start with http:// or https://, got '
                . ($scheme === '' ? 'no scheme' : "scheme '{$scheme}'")];
        }
        if (!isset($parts['host'])) {
            return ['baseUrl: must include a host, and no host could be read from it'];
        }
        $problems = [];
        if (isset($parts['user']) || isset($parts['pass'])) {
            $problems[] = "baseUrl: host {$parts['host']} carries embedded credentials, which would "
                . 'replace the bearer token; strip the userinfo';
        }
        if (isset($parts['query']) || isset($parts['fragment'])) {
            $carries = isset($parts['query'])
                ? (isset($parts['fragment']) ? 'a query string and a fragment' : 'a query string')
                : 'a fragment';
            $problems[] = 'baseUrl: must be the instance origin only, and this one carries '
                . $carries . ' - pass scheme://host[:port] and nothing after it';
        }
        return $problems;
    }

    /** Redacted one-line view. */
    public function __toString(): string
    {
        $shown = Redaction::redactFields($this, self::REQUIRED_FIELDS);
        $shown[] = 'tokenCachePath=' . ($this->tokenCachePath === null ? 'memory-only' : 'set');
        return 'AuthConfig(' . implode(', ', $shown) . ')';
    }

    /** Redacted view for var_dump().
     *  @return array<string,string> */
    public function __debugInfo(): array
    {
        return ['redacted' => (string) $this];
    }
}
