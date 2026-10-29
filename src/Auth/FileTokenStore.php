<?php

declare(strict_types=1);

namespace WebCommander\Auth;

use WebCommander\Config\SdkConfig;
use WebCommander\Errors\SdkConfigError;
use WebCommander\Errors\SdkError;

/** Token storage in a JSON file, shared across processes under a cross-process lock, keyed by
 *  namespace. */
final class FileTokenStore implements TokenStore
{
    private const LOCK_SUFFIX = '.lock';
    private const LOCK_TIMEOUT_SECONDS = 30.0;
    private const LOCK_POLL_MICROSECONDS = 50000;
    private const REPLACE_RETRY_ATTEMPTS = 5;
    private const REPLACE_RETRY_INITIAL_MICROSECONDS = 10000;

    private readonly string $lockPath;
    private readonly string $namespace;
    private readonly int $maxBytes;
    private int $lockDepth = 0;
    /** @var resource|null */
    private $lockHandle = null;

    /** @param int|null $maxBytes null takes {@see SdkConfig::DEFAULT_MAX_TOKEN_CACHE_BYTES} */
    public function __construct(
        private readonly string $filePath,
        ?string $namespace = null,
        ?int $maxBytes = null,
    ) {
        $this->maxBytes = $maxBytes !== null && $maxBytes > 0 ? $maxBytes : SdkConfig::DEFAULT_MAX_TOKEN_CACHE_BYTES;
        $this->lockPath = $filePath . self::LOCK_SUFFIX;
        $this->namespace = $namespace !== null && $namespace !== '' ? $namespace : 'default';
        $parent = dirname($filePath);
        if ($parent !== '' && !is_dir($parent)) {
            if (!@mkdir($parent, 0700, true) && !is_dir($parent)) {
                throw new SdkConfigError(
                    'tokenCachePath: the directory the configured cache path lives in could not '
                    . 'be created; pass a path whose parent exists, or null to keep the token in '
                    . 'memory. The path is on getErrorMessages()',
                    errors: ['tokenCachePath: ' . $filePath],
                );
            }
        }
    }

    /** @return array<string,mixed>|null */
    public function readTokenRecord(): ?array
    {
        $entry = $this->readAllNamespaces()[$this->namespace] ?? null;
        return is_array($entry) ? $entry : null;
    }

    /** @param array<string,mixed> $record */
    public function writeTokenRecord(array $record): void
    {
        $lock = $this->acquireTokenRefreshLock();
        try {
            $stored = $this->readAllNamespaces();
            $stored[$this->namespace] = $record;
            $this->writeAllNamespaces($stored);
        } finally {
            $lock->release();
        }
    }

    /** Remove this namespace's entry, and the data file once no namespace is left. */
    public function clearTokenRecord(): void
    {
        $lock = $this->acquireTokenRefreshLock();
        try {
            $stored = $this->namespacesOrNullWhenCorrupt();
            if ($stored === null) {
                $this->deleteTokenFile();
                return;
            }
            if (!array_key_exists($this->namespace, $stored)) {
                return;
            }
            unset($stored[$this->namespace]);
            if ($stored !== []) {
                $this->writeAllNamespaces($stored);
            } else {
                $this->deleteTokenFile();
            }
        } finally {
            $lock->release();
        }
    }

    private function deleteTokenFile(): void
    {
        [$deleted, $reason] = self::withOsReason(fn () => unlink($this->filePath));
        clearstatcache(true, $this->filePath);
        if ($deleted || !file_exists($this->filePath)) {
            return;
        }
        throw new SdkError(
            'the cached token could not be deleted and is still on disk; the path and the '
            . 'reason the operating system gave are on getErrorMessages()',
            errors: $this->pathDetail($reason),
        );
    }

    /** @return array{0:mixed,1:?string} the result, and the OS reason from PHP's warning */
    private static function withOsReason(\Closure $operation): array
    {
        $reason = null;
        set_error_handler(static function (int $severity, string $message) use (&$reason): bool {
            $reason = $message;
            return true;
        });
        try {
            $result = $operation();
        } finally {
            restore_error_handler();
        }
        return [$result, $reason === null ? null : (string) preg_replace('/^\w+\(.*?\):\s*/', '', $reason)];
    }

    public function acquireTokenRefreshLock(): TokenRefreshLock
    {
        if ($this->lockDepth > 0) {
            $this->lockDepth++;
            return $this->makeHandle();
        }
        $handle = @fopen($this->lockPath, 'c');
        if ($handle === false) {
            throw new SdkConfigError(
                'tokenCachePath: the lock file beside the cache could not be opened; point '
                . 'tokenCachePath at a writable directory, or pass null to keep the token in '
                . 'memory. The path is on getErrorMessages()',
                errors: $this->pathDetail(),
            );
        }
        if (!$this->lockSidecar($handle)) {
            fclose($handle);
            throw new SdkError(
                'the token refresh lock was held elsewhere for longer than '
                . self::LOCK_TIMEOUT_SECONDS . 's, so this refresh was not attempted. Another '
                . 'process is refreshing, or one exited without releasing the lock; the sidecar '
                . 'path is on getErrorMessages()',
                errors: $this->pathDetail(),
            );
        }
        $this->lockHandle = $handle;
        $this->lockDepth = 1;
        return $this->makeHandle();
    }

    /** Give back one level of the reentrant lock, dropping the OS lock on the last one.
     *  @internal called by the lock handle returned from acquireTokenRefreshLock */
    public function releaseLock(): void
    {
        if ($this->lockDepth === 0) {
            return;
        }
        $this->lockDepth--;
        if ($this->lockDepth > 0) {
            return;
        }
        if (is_resource($this->lockHandle)) {
            flock($this->lockHandle, LOCK_UN);
            fclose($this->lockHandle);
        }
        $this->lockHandle = null;
    }

    private function makeHandle(): TokenRefreshLock
    {
        return new class ($this) implements TokenRefreshLock {
            private bool $released = false;

            public function __construct(private readonly FileTokenStore $store)
            {
            }

            public function release(): void
            {
                if ($this->released) {
                    return;
                }
                $this->released = true;
                $this->store->releaseLock();
            }
        };
    }

    /** @param resource $handle */
    private function lockSidecar($handle): bool
    {
        $deadline = microtime(true) + self::LOCK_TIMEOUT_SECONDS;
        while (true) {
            if (@flock($handle, LOCK_EX | LOCK_NB)) {
                return true;
            }
            if (microtime(true) >= $deadline) {
                return false;
            }
            usleep(self::LOCK_POLL_MICROSECONDS);
        }
    }

    /** @return array<string,mixed> */
    private function readAllNamespaces(): array
    {
        $content = $this->readCacheFile();
        if ($content === null || trim($content) === '') {
            return [];
        }
        if (!mb_check_encoding($content, 'UTF-8')) {
            throw $this->corruptCache('it is not valid UTF-8');
        }
        $decoded = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw $this->corruptCache('it is not valid JSON: ' . json_last_error_msg());
        }
        if (!is_array($decoded) || (array_is_list($decoded) && $decoded !== [])) {
            throw $this->corruptCache(
                'it holds ' . get_debug_type($decoded) . ' where a mapping of namespaces was expected'
            );
        }
        return $decoded;
    }

    private function namespacesOrNullWhenCorrupt(): ?array
    {
        try {
            return $this->readAllNamespaces();
        } catch (SdkConfigError $unreadable) {
            throw $unreadable;
        } catch (SdkError) {
            return null;
        }
    }

    private function readCacheFile(): ?string
    {
        // The one byte past the ceiling proves the file went over it.
        [$content, $reason] = self::withOsReason(
            fn () => file_get_contents($this->filePath, false, null, 0, $this->maxBytes + 1),
        );
        if (is_string($content) && strlen($content) > $this->maxBytes) {
            throw new SdkConfigError(
                "tokenCachePath: the token cache exceeds the {$this->maxBytes}-byte "
                . 'maxTokenCacheBytes and was not read. The path is on getErrorMessages()',
                errors: $this->pathDetail(),
            );
        }
        if ($content !== false) {
            return $content;
        }
        clearstatcache(true, $this->filePath);
        if (!file_exists($this->filePath)) {
            return null;
        }
        throw new SdkConfigError(
            'tokenCachePath: the token cache exists but could not be read; fix its permissions, '
            . 'or pass null to keep the token in memory. The path and the reason the operating '
            . 'system gave are on getErrorMessages()',
            errors: $this->pathDetail($reason),
        );
    }

    /** The withheld half of a cache refusal, carried on `getErrorMessages()` rather than in
     *  the message an uncaught exception prints.
     *  @return list<string> */
    private function pathDetail(?string $osReason = null): array
    {
        $detail = [
            'tokenCachePath: ' . $this->filePath,
            'lock_sidecar: ' . $this->lockPath,
        ];
        if ($osReason !== null && $osReason !== '') {
            $detail[] = 'os_reason: ' . $osReason;
        }
        return $detail;
    }

    private function corruptCache(string $why): SdkError
    {
        return new SdkError(
            "the token cache is not usable: {$why}. Nothing has been read from it and nothing "
            . 'has been written over it; call clearTokenRecord() to discard it, or delete that '
            . 'file - its path is on getErrorMessages()',
            errors: $this->pathDetail(),
        );
    }

    /** @param array<string,mixed> $stored */
    private function writeAllNamespaces(array $stored): void
    {
        $dir = dirname($this->filePath);
        if ($dir !== '' && !is_dir($dir)) {
            @mkdir($dir, 0700, true);
        }
        $temporary = tempnam($dir === '' ? '.' : $dir, basename($this->filePath));
        if ($temporary === false) {
            throw new SdkError(
                'the token cache could not be written: no temp file could be created beside it. '
                . 'The path is on getErrorMessages()',
                errors: $this->pathDetail(),
            );
        }
        try {
            $encoded = json_encode($stored, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            if ($encoded === false) {
                throw new SdkError(
                    'the token cache could not be written: it would not encode as JSON ('
                    . json_last_error_msg() . ')',
                    errors: $this->pathDetail(),
                );
            }
            $bytesWritten = file_put_contents($temporary, $encoded);
            if ($bytesWritten !== strlen($encoded)) {
                throw new SdkError(
                    'the token cache could not be written: the temp file took '
                    . var_export($bytesWritten, true) . ' of ' . strlen($encoded) . ' byte(s)',
                    errors: $this->pathDetail(),
                );
            }
            $this->replaceTokenFile($temporary);
            TokenCache::restrictToOwner($this->filePath);
        } catch (\Throwable $error) {
            @unlink($temporary);
            throw $error;
        }
    }

    private function replaceTokenFile(string $temporary): void
    {
        for ($attempt = 0; $attempt < self::REPLACE_RETRY_ATTEMPTS; $attempt++) {
            if (@rename($temporary, $this->filePath)) {
                return;
            }
            if (PHP_OS_FAMILY !== 'Windows' || $attempt === self::REPLACE_RETRY_ATTEMPTS - 1) {
                throw new SdkError(
                    'the token cache could not be written: the freshly written temp file could '
                    . 'not be renamed over it. The path is on getErrorMessages()',
                    errors: $this->pathDetail(),
                );
            }
            usleep(self::REPLACE_RETRY_INITIAL_MICROSECONDS * (2 ** $attempt));
        }
    }
}
