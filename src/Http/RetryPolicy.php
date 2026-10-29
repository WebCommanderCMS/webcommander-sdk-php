<?php

declare(strict_types=1);

namespace WebCommander\Http;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Client\NetworkExceptionInterface;
use WebCommander\Config\SdkConfig;
use WebCommander\Errors\SdkConfigError;

final readonly class RetryPolicy
{
    public const DEFAULT_RETRYABLE_HTTP_CODES = [429, 500, 502, 503, 504];
    /** @var list<int> Empty: a 429 or a 503 does not prove an unsafe write was not applied. */
    public const DEFAULT_UNSAFE_RETRYABLE_HTTP_CODES = [];
    /** @var list<string> RFC 9110 safe methods. */
    public const SAFE_METHODS = ['GET', 'HEAD', 'OPTIONS', 'TRACE'];
    /** @var list<string> RFC 9110 idempotent methods. */
    public const IDEMPOTENT_METHODS = ['GET', 'HEAD', 'OPTIONS', 'TRACE', 'PUT', 'DELETE'];

    /** The lowest and highest values RFC 9110 allows a status code to take. */
    public const MIN_STATUS_CODE = 100;
    public const MAX_STATUS_CODE = 599;
    /** Keeps 2 ** n finite. */
    private const MAX_BACKOFF_EXPONENT = 62;
    /** CURLE_OPERATION_TIMEDOUT. */
    private const TIMEOUT_CURL_ERRNO = 28;
    /** curl TLS handshake errnos. */
    private const TLS_CURL_ERRNOS = [35, 51, 53, 54, 58, 59, 60, 64, 66, 77, 80, 82, 83, 90, 91];

    /** @var list<int> */
    public array $retryableStatusCodes;
    /** @var list<int> */
    public array $unsafeRetryableStatusCodes;

    /** @param list<int> $retryableStatusCodes
     *  @param list<int> $unsafeRetryableStatusCodes */
    public function __construct(
        public int $maxAttempts = 1,
        public float $backoffSeconds = 0.5,
        public float $backoffMaxSeconds = 20.0,
        array $retryableStatusCodes = self::DEFAULT_RETRYABLE_HTTP_CODES,
        array $unsafeRetryableStatusCodes = self::DEFAULT_UNSAFE_RETRYABLE_HTTP_CODES,
    ) {
        // public constructor: a policy can reach the transport without an SdkConfig
        $this->retryableStatusCodes = self::validatedStatusCodes($retryableStatusCodes, 'retryableStatusCodes');
        $this->unsafeRetryableStatusCodes = self::validatedStatusCodes(
            $unsafeRetryableStatusCodes,
            'unsafeRetryableStatusCodes'
        );
        if ($this->maxAttempts < 1) {
            throw new SdkConfigError(
                "maxAttempts: must be at least 1 (1 disables retry), got {$this->maxAttempts}"
            );
        }
        if (!is_finite($this->backoffSeconds) || $this->backoffSeconds < 0) {
            throw new SdkConfigError("backoffSeconds: must be a finite number >= 0, got {$this->backoffSeconds}");
        }
        if (!is_finite($this->backoffMaxSeconds) || $this->backoffMaxSeconds < $this->backoffSeconds) {
            throw new SdkConfigError('backoffMaxSeconds: must be a finite number >= backoffSeconds');
        }
    }

    /** A status-code list rebuilt one scalar at a time: `readonly` plus copy-on-write does not detach
     *  a caller's reference slot, so a scalar could otherwise move after validation.
     *  @param array<int|string,mixed> $codes
     *  @return list<mixed> */
    public static function detachStatusCodes(array $codes): array
    {
        $detached = [];
        foreach ($codes as $code) {
            $detached[] = $code;
        }
        return $detached;
    }

    /** @param array<int|string,mixed> $codes
     *  @return list<int> */
    private static function validatedStatusCodes(array $codes, string $field): array
    {
        $validated = [];
        foreach (self::detachStatusCodes($codes) as $code) {
            if (!is_int($code)) {
                throw new SdkConfigError(
                    "{$field}: expected HTTP status codes as integers, got " . get_debug_type($code)
                );
            }
            if ($code < self::MIN_STATUS_CODE || $code > self::MAX_STATUS_CODE) {
                throw new SdkConfigError(
                    "{$field}: {$code} is not an HTTP status code - RFC 9110 allows "
                    . self::MIN_STATUS_CODE . ' through ' . self::MAX_STATUS_CODE
                );
            }
            $validated[] = $code;
        }
        return $validated;
    }

    public static function isMethodToken(string $method): bool
    {
        return preg_match(Transport::TOKEN_PATTERN, $method) === 1;
    }

    public static function fromConfig(SdkConfig $config): self
    {
        return new self(
            maxAttempts: $config->maxRetries,
            backoffSeconds: $config->retryBackoffSeconds,
            backoffMaxSeconds: $config->retryBackoffMaxSeconds,
            retryableStatusCodes: $config->retryableHttpCodes,
            unsafeRetryableStatusCodes: $config->unsafeRetryableHttpCodes,
        );
    }

    /** A non-safe method also needs the status on `unsafeRetryableStatusCodes`. */
    public function shouldRetryStatusCode(int $statusCode, string $method = 'GET'): bool
    {
        if (!in_array($statusCode, $this->retryableStatusCodes, true)) {
            return false;
        }
        if (self::isSafeMethod($method)) {
            return true;
        }
        return in_array($statusCode, $this->unsafeRetryableStatusCodes, true);
    }

    /** Any method when nothing was sent; only idempotent methods after the request went out. */
    public function shouldRetryAfterException(\Throwable $exception, string $method = 'GET'): bool
    {
        if (self::connectionWasNeverEstablished($exception)) {
            return true;
        }
        return self::isIdempotentMethod($method) && self::isTransportFailure($exception);
    }

    public function shouldRetryAfterResponseBodyFailure(string $method): bool
    {
        return self::isIdempotentMethod($method);
    }

    /** curl connect_time 0: nothing was sent. */
    private static function connectionWasNeverEstablished(\Throwable $exception): bool
    {
        if (self::isTlsHandshake($exception)) {
            return true;
        }
        if (!$exception instanceof ConnectException) {
            return false;
        }
        $context = $exception->getHandlerContext();
        if (!array_key_exists('connect_time', $context)) {
            return false;
        }
        return (float) $context['connect_time'] === 0.0
            && (float) ($context['size_upload'] ?? 0) === 0.0;
    }

    private static function isTransportFailure(\Throwable $exception): bool
    {
        return $exception instanceof ConnectException
            || $exception instanceof NetworkExceptionInterface
            || self::isTimeout($exception);
    }

    /** Exponential backoff with full jitter. */
    public function computeBackoffSeconds(int $attempt, ?string $retryAfter = null): float
    {
        $serverDelay = self::parseRetryAfter($retryAfter);
        if ($serverDelay !== null) {
            return min($serverDelay, $this->backoffMaxSeconds);
        }
        $exponent = min(max(0, $attempt - 1), self::MAX_BACKOFF_EXPONENT);
        $window = min($this->backoffSeconds * (2 ** $exponent), $this->backoffMaxSeconds);
        return (mt_rand() / mt_getrandmax()) * $window;
    }

    /** By curl errno, never the message. */
    public static function isTimeout(\Throwable $exception): bool
    {
        return self::curlErrno($exception) === self::TIMEOUT_CURL_ERRNO;
    }

    private static function curlErrno(\Throwable $exception): ?int
    {
        if (!$exception instanceof RequestException && !$exception instanceof ConnectException) {
            return null;
        }
        $errno = $exception->getHandlerContext()['errno'] ?? null;
        return is_numeric($errno) ? (int) $errno : null;
    }

    private static function isTlsHandshake(\Throwable $exception): bool
    {
        $errno = self::curlErrno($exception);
        if ($errno !== null) {
            return in_array($errno, self::TLS_CURL_ERRNOS, true);
        }
        $message = strtolower($exception->getMessage());
        return str_contains($message, 'ssl certificate')
            || str_contains($message, 'certificate verify')
            || str_contains($message, 'certificate problem')
            || str_contains($message, 'ssl connect error')
            || str_contains($message, 'unable to get local issuer');
    }

    public static function isSafeMethod(string $method): bool
    {
        $normalised = strtoupper(trim($method));
        return in_array($normalised, self::SAFE_METHODS, true);
    }

    /** A method not on the list, and a non-token, is treated as non-idempotent. */
    private static function isIdempotentMethod(string $method): bool
    {
        $normalised = strtoupper(trim($method));
        return in_array($normalised, self::IDEMPOTENT_METHODS, true);
    }

    private static function parseRetryAfter(?string $retryAfter): ?float
    {
        if ($retryAfter === null || trim($retryAfter) === '') {
            return null;
        }
        $value = trim($retryAfter);
        if (is_numeric($value)) {
            return max(0.0, (float) $value);
        }
        $timestamp = strtotime($value);
        if ($timestamp === false) {
            return null;
        }
        return max(0.0, (float) ($timestamp - time()));
    }
}
