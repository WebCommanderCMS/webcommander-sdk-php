<?php

declare(strict_types=1);

namespace WebCommander\Http;

use Psr\Http\Client\ClientExceptionInterface;
use RuntimeException;

/** The transfer was stopped because the response body reached `maxResponseBytes`. */
final class ResponseTooLargeException extends RuntimeException implements ClientExceptionInterface
{
    public function __construct(
        public readonly string $httpMethod,
        public readonly string $redactedUrl,
        public readonly int $cap,
        public readonly ?int $declaredLength,
        public readonly ?int $receivedBytes,
    ) {
        parent::__construct(sprintf(
            '%s %s: the response body is larger than the %d-byte maxResponseBytes cap (%s)',
            $httpMethod,
            $redactedUrl,
            $cap,
            $declaredLength !== null
                ? sprintf('Content-Length declared %d, so nothing was downloaded', $declaredLength)
                : sprintf('length not declared, so the transfer was stopped after %d byte(s)', $receivedBytes ?? 0),
        ));
    }
}
