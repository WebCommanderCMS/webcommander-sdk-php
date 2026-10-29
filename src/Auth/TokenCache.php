<?php

declare(strict_types=1);

namespace WebCommander\Auth;

/** Auth fingerprint for keying a shared token file, and the platform per-user cache path. */
final class TokenCache
{
    private const DEFAULT_FILENAME = 'wc_php_token.json';

    public static function buildCredentialsNamespace(
        string $baseUrl,
        string $clientId,
        string $clientSecret = '',
        string $authString = '',
        string $grantType = '',
    ): string {
        $material = '';
        foreach (['v3', $baseUrl, $clientId, $clientSecret, $authString, $grantType] as $value) {
            $material .= mb_strlen($value, 'UTF-8') . ':' . $value;
        }
        return substr(hash('sha256', $material), 0, 16);
    }

    /** The per-user cache path for this platform; the directory is created if missing and
     *  owner-restricted where the platform supports it. */
    public static function defaultPath(string $filename = self::DEFAULT_FILENAME): string
    {
        $home = self::homeDirectory();
        if (PHP_OS_FAMILY === 'Windows') {
            $root = getenv('LOCALAPPDATA') ?: $home;
        } elseif (PHP_OS_FAMILY === 'Darwin') {
            $root = $home . DIRECTORY_SEPARATOR . 'Library' . DIRECTORY_SEPARATOR . 'Caches';
        } else {
            $root = getenv('XDG_CACHE_HOME') ?: ($home . DIRECTORY_SEPARATOR . '.cache');
        }
        if (!self::isAbsolute($root)) {
            $root = sys_get_temp_dir();
        }
        $directory = $root . DIRECTORY_SEPARATOR . 'webcommander';
        if (!is_dir($directory)) {
            @mkdir($directory, 0700, true);
        }
        self::restrictToOwner($directory);
        return $directory . DIRECTORY_SEPARATOR . $filename;
    }

    public static function restrictToOwner(string $path): void
    {
        if (PHP_OS_FAMILY === 'Windows') {
            return;
        }
        @chmod($path, is_dir($path) ? 0700 : 0600);
    }

    private static function homeDirectory(): string
    {
        return getenv('HOME')
            ?: (getenv('USERPROFILE') ?: sys_get_temp_dir());
    }

    private static function isAbsolute(string $path): bool
    {
        if ($path === '') {
            return false;
        }
        if (PHP_OS_FAMILY === 'Windows') {
            return (bool) preg_match('#^[A-Za-z]:[\\\\/]#', $path) || str_starts_with($path, '\\\\');
        }
        return str_starts_with($path, '/');
    }
}
