<?php

declare(strict_types=1);

namespace WebCommander\Client;

use WebCommander\Redaction;

/** Everything about the request that produced a response; queryParams and the URL are redacted here. */
final class RequestInfo
{
    /** @var array<string,mixed> */
    public readonly array $queryParams;
    public readonly string $url;

    /** @param array<string,mixed> $queryParams
     *  @param array<string,string> $headers already redacted by the caller
     *  @param string|null $endpointTemplate the one path form printed unasked; a resolved path carries the id */
    public function __construct(
        public readonly string $clientName,
        public readonly string $apiVersion,
        public readonly string $httpMethod,
        string $url,
        array $queryParams = [],
        public readonly mixed $body = null,
        public readonly array $headers = [],
        public readonly int $attemptCount = 1,
        public readonly int $maxAttempts = 1,
        public readonly float $elapsedSeconds = 0.0,
        public readonly ?string $endpointTemplate = null,
    ) {
        $this->url = Redaction::redactValue($url);
        $this->queryParams = Redaction::redactMapping($queryParams);
    }
}
