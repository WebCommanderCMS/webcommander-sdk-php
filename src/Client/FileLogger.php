<?php

declare(strict_types=1);

namespace WebCommander\Client;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/** A minimal single-line file logger, used when the caller sets `logFile` but injects no
 *  PSR-3 logger. Closed on WebCommanderClient::closeClient(). */
final class FileLogger extends AbstractLogger
{
    public const SEVERITY = [
        LogLevel::DEBUG => 0,
        LogLevel::INFO => 1,
        LogLevel::NOTICE => 1,
        LogLevel::WARNING => 2,
        LogLevel::ERROR => 3,
        LogLevel::CRITICAL => 4,
        LogLevel::ALERT => 5,
        LogLevel::EMERGENCY => 6,
    ];

    /** @var resource|null */
    private $handle;
    private readonly int $minSeverity;

    public function __construct(string $path, string $minLevel = 'WARNING')
    {
        $this->minSeverity = self::SEVERITY[strtolower($minLevel)] ?? 2;
        $handle = @fopen($path, 'a');
        $this->handle = $handle === false ? null : $handle;
    }

    /** @param array<string,mixed> $context */
    public function log($level, string|\Stringable $message, array $context = []): void
    {
        if ($this->handle === null) {
            return;
        }
        $severity = self::SEVERITY[strtolower((string) $level)] ?? 2;
        if ($severity < $this->minSeverity) {
            return;
        }
        $line = sprintf("%s %s %s\n", date('c'), strtoupper((string) $level), self::interpolate((string) $message, $context));
        @fwrite($this->handle, $line);
    }

    public function close(): void
    {
        if (is_resource($this->handle)) {
            fclose($this->handle);
        }
        $this->handle = null;
    }

    /** @param array<string,mixed> $context */
    private static function interpolate(string $message, array $context): string
    {
        if ($context === []) {
            return $message;
        }
        $replacements = [];
        foreach ($context as $key => $value) {
            if (is_scalar($value) || $value instanceof \Stringable) {
                $replacements['{' . $key . '}'] = (string) $value;
            }
        }
        return strtr($message, $replacements);
    }
}
