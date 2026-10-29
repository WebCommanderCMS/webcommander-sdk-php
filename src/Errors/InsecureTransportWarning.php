<?php

declare(strict_types=1);

namespace WebCommander\Errors;

use Psr\Log\LoggerInterface;

/** Warning for disabled TLS verification or plaintext http://. */
final class InsecureTransportWarning
{
    public static function emit(string $message, ?LoggerInterface $logger = null): void
    {
        $logger?->warning($message);
        @trigger_error($message, E_USER_WARNING);
    }
}
