<?php

declare(strict_types=1);

namespace WebCommander\Auth;

use WebCommander\Errors\SdkUsageError;
use WebCommander\Redaction;

/** An access token and when it stops being usable; skew is carried per record. */
final readonly class TokenRecord
{
    public const DEFAULT_TTL_SECONDS = 3600;
    public const SKEW_SECONDS = 60;
    public const MAX_TTL_SECONDS = 86400;

    public string $accessToken;
    public ?string $refreshToken;

    public function __construct(
        #[\SensitiveParameter] string $accessToken,
        #[\SensitiveParameter] ?string $refreshToken,
        public float $expiresAt,
        public float $skewSeconds = self::SKEW_SECONDS,
    ) {
        $usable = self::sendableTokenText($accessToken);
        if ($usable === null) {
            throw new SdkUsageError('access_token is not a valid RFC 6750 b64token');
        }
        $this->accessToken = $usable;
        $this->refreshToken = self::acceptedRefreshToken($refreshToken);
    }

    public static function sendableTokenText(#[\SensitiveParameter] string $text): ?string
    {
        return preg_match('/^[A-Za-z0-9\-._~+\/]+=*$/D', $text) === 1 ? $text : null;
    }

    /** The refresh token as it would be form-encoded back, or null where there is none. */
    public static function refreshTokenText(#[\SensitiveParameter] string $text): ?string
    {
        if (trim($text, ' ') === '') {
            return null;
        }
        return preg_match('/^[\x20-\x7e]+$/D', $text) === 1 ? $text : null;
    }

    private static function acceptedRefreshToken(#[\SensitiveParameter] ?string $refreshToken): ?string
    {
        if ($refreshToken === null || trim($refreshToken) === '') {
            return null;
        }
        $usable = self::refreshTokenText($refreshToken);
        if ($usable === null) {
            throw new SdkUsageError('refresh_token must be visible ASCII; pass null where there is none');
        }
        return $usable;
    }

    /** Whether the token should be treated as expired; $now defaults to the wall clock. */
    public function needsRefresh(?float $skewSeconds = null, ?float $now = null): bool
    {
        $effectiveSkew = $skewSeconds ?? $this->skewSeconds;
        $now ??= microtime(true);
        if ($this->expiresAt - $now > self::MAX_TTL_SECONDS) {
            // Further ahead than any accepted lifetime, so the stamp is another clock's.
            return true;
        }
        return $now >= ($this->expiresAt - $effectiveSkew);
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return [
            'access_token' => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'expires_at' => $this->expiresAt,
            'skew_seconds' => $this->skewSeconds,
        ];
    }

    /** Rebuild from a stored mapping; null when unusable.
     *  @param array<string,mixed>|null $record */
    public static function fromArray(?array $record): ?self
    {
        if (!$record) {
            return null;
        }
        $access = $record['access_token'] ?? null;
        $access = is_string($access) ? self::sendableTokenText($access) : null;
        $expires = $record['expires_at'] ?? null;
        if ($access === null
            || !(is_int($expires) || is_float($expires)) || !is_finite((float) $expires)) {
            return null;
        }
        $skew = $record['skew_seconds'] ?? null;
        if (!(is_int($skew) || is_float($skew)) || !is_finite((float) $skew) || $skew < 0) {
            $skew = self::SKEW_SECONDS;
        }
        $refresh = $record['refresh_token'] ?? null;
        return new self(
            $access,
            is_string($refresh) ? self::refreshTokenText($refresh) : null,
            (float) $expires,
            (float) $skew,
        );
    }

    /** Redacted view; expiry as remaining seconds. */
    public function __toString(): string
    {
        $shown = Redaction::redactFields($this, ['accessToken', 'refreshToken']);
        $shown[] = 'expiresIn=' . $this->renderRemainingSeconds();
        $shown[] = 'skewSeconds=' . $this->skewSeconds;
        return 'TokenRecord(' . implode(', ', $shown) . ')';
    }

    private function renderRemainingSeconds(): string
    {
        $remaining = $this->expiresAt - microtime(true);
        if (!is_finite($remaining)) {
            return 'unusable';
        }
        return $remaining <= 0 ? 'expired' : ((int) floor($remaining)) . 's';
    }
}
