<?php

declare(strict_types=1);

namespace WebCommander\Http;

use GuzzleHttp\Psr7\MultipartStream;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Closure;
use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\ErrorType;
use WebCommander\Client\RequestInfo;
use WebCommander\Config\SdkConfig;
use WebCommander\Errors\SdkError;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Redaction;

/** HTTP execution: one client per instance, timeouts, TLS, retries, decoding. */
final class Transport
{
    /** RFC 9110 token: a method or a header name. */
    public const TOKEN_PATTERN = '/^[!#$%&\'*+\-.^_`|~0-9A-Za-z]+$/D';
    private const CHUNK_BYTES = 65536;
    /** The one multipart media type this SDK builds and the one it will accept back. */
    private const MULTIPART_MEDIA_TYPE = 'multipart/form-data';
    private const BOUNDARY_ATTEMPTS = 3;
    /** @var array<string,string> */
    private const MULTIPART_FORBIDDEN_BYTES = ['CR' => "\r", 'LF' => "\n", 'NUL' => "\0"];
    /** The error code whose `message` names its parameters in a fixed form. */
    private const UNKNOWN_PARAMETER_ERROR = 'unknown_parameter';
    /** Empty, or printable ASCII with space and tab only between two printable characters. */
    private const HEADER_VALUE_PATTERN = '/^$|^[\x21-\x7E]$|^[\x21-\x7E][\x20\x09\x21-\x7E]*[\x21-\x7E]$/D';

    private ?ClientInterface $httpClient;
    private readonly bool $ownsClient;
    private readonly RetryPolicy $retryPolicy;
    private readonly RequestFactoryInterface $requestFactory;
    private readonly StreamFactoryInterface $streamFactory;
    /** @var callable */
    private $onProgress;

    public function __construct(
        private readonly SdkConfig $config,
        ?RetryPolicy $retryPolicy = null,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
        ?callable $onProgress = null,
    ) {
        $this->ownsClient = $httpClient === null;
        $this->httpClient = $httpClient ?? GuzzleClientFactory::create($config);
        $factory = GuzzleClientFactory::factory();
        $this->requestFactory = $requestFactory ?? $factory;
        $this->streamFactory = $streamFactory ?? $factory;
        $this->retryPolicy = $retryPolicy ?? RetryPolicy::fromConfig($config);
        $this->onProgress = $onProgress ?? static fn (string $m): null => null;
    }

    /** Materialise one logical request into the single representation every attempt sends.
     *  @param array<string,mixed>|null $params
     *  @param string|null $endpointTemplate e.g. `/api/{api_version}/admin/customers/{customer_id}`
     *  @return array{method:string,url:string,params:array<string,mixed>|null,
     *  body:StreamInterface|null,contentType:string|null,replayable:bool,
     *  endpointTemplate:string|null} */
    public function materializeRequest(
        string $httpMethod,
        #[\SensitiveParameter] string $url,
        #[\SensitiveParameter] ?array $params = null,
        #[\SensitiveParameter] mixed $jsonBody = null,
        #[\SensitiveParameter] mixed $formData = null,
        #[\SensitiveParameter] mixed $files = null,
        ?string $endpointTemplate = null,
    ): array {
        $method = self::normalizeMethod($httpMethod);
        self::refuseUnsendableMultipartLabels($files, $formData);

        $formData = self::freezeFormPayload($formData);
        $finalUrl = self::mergeQuery($url, $params);
        [$bodyStream, $contentType] = $this->buildBody($jsonBody, $formData, $files);

        return [
            'method' => $method,
            'url' => $finalUrl,
            'params' => $params,
            'body' => $bodyStream,
            'contentType' => $contentType,
            'replayable' => $bodyStream === null || $bodyStream->isSeekable(),
            'endpointTemplate' => $endpointTemplate,
        ];
    }

    /** Return a materialised body to its start, so the same bytes can be sent again.
     *  @param array{body?:StreamInterface|null,replayable?:bool} $wire */
    public static function rewindMaterializedBody(array $wire): bool
    {
        if (($wire['replayable'] ?? false) !== true) {
            return false;
        }
        $body = $wire['body'] ?? null;
        return self::rewind($body instanceof StreamInterface ? $body : null);
    }

    /** Materialise and send in one step, for a caller holding a Transport directly.
     *  @param array<string,mixed>|null $params
     *  @param array<string,string>|null $headers
     *  @param array<string,string>|null $requestInfoHeaders
     *  @param string|null $responseFormat null takes the client's configured value
     *  @param class-string<Dto>|(Closure(array<string,mixed>): Dto)|null $dtoType */
    public function sendHttpRequest(
        string $httpMethod,
        #[\SensitiveParameter] string $url,
        #[\SensitiveParameter] ?array $params = null,
        #[\SensitiveParameter] mixed $jsonBody = null,
        #[\SensitiveParameter] mixed $formData = null,
        #[\SensitiveParameter] mixed $files = null,
        #[\SensitiveParameter] ?array $headers = null,
        #[\SensitiveParameter] ?array $requestInfoHeaders = null,
        #[\SensitiveParameter] mixed $requestInfoBody = null,
        ?string $responseFormat = null,
        string|Closure|null $dtoType = null,
        ?string $endpointTemplate = null,
    ): ApiResponse {
        self::refuseUnsendableHeaders($headers);
        return $this->sendMaterializedRequest(
            $this->materializeRequest($httpMethod, $url, $params, $jsonBody, $formData, $files, $endpointTemplate),
            $headers,
            $requestInfoHeaders,
            $requestInfoBody,
            $responseFormat,
            $dtoType,
        );
    }

    /** Send an already-materialised request, retrying it as the policy allows.
     *  @param array{method:string,url:string,params:array<string,mixed>|null,
     *  body:StreamInterface|null,contentType:string|null,replayable:bool,
     *  endpointTemplate:string|null} $wire
     *  @param array<string,string>|null $headers
     *  @param array<string,string>|null $requestInfoHeaders
     *  @param class-string<Dto>|(Closure(array<string,mixed>): Dto)|null $dtoType */
    public function sendMaterializedRequest(
        array $wire,
        #[\SensitiveParameter] ?array $headers = null,
        #[\SensitiveParameter] ?array $requestInfoHeaders = null,
        #[\SensitiveParameter] mixed $requestInfoBody = null,
        ?string $responseFormat = null,
        string|Closure|null $dtoType = null,
    ): ApiResponse {
        self::refuseUnsendableHeaders($headers);

        $method = $wire['method'];
        $finalUrl = $wire['url'];
        $params = $wire['params'];
        $bodyStream = $wire['body'];
        $contentType = $wire['contentType'];
        $replayable = $wire['replayable'];
        $endpointTemplate = $wire['endpointTemplate'];

        $request = $this->requestFactory->createRequest($method, $finalUrl);
        foreach ($headers ?? [] as $name => $value) {
            $request = $request->withHeader((string) $name, $value);
        }
        if ($contentType !== null) {
            if (self::boundaryParameter($contentType) === null) {
                if (!$request->hasHeader('Content-Type')) {
                    $request = $request->withHeader('Content-Type', $contentType);
                }
            } else {
                if ($request->hasHeader('Content-Type')) {
                    self::requireBodyOwnedMediaType($request->getHeaderLine('Content-Type'), $contentType);
                }
                $request = $request->withHeader('Content-Type', $contentType);
            }
        }
        if ($bodyStream !== null) {
            $request = $request->withBody($bodyStream);
        }

        $started = hrtime(true);
        $attempt = 0;
        $requestsSent = 0;
        $staleEchoResent = false;
        $lastException = null;

        while ($attempt < $this->retryPolicy->maxAttempts) {
            $attempt++;
            $requestsSent++;
            // template only: the resolved URL carries ids and search terms
            ($this->onProgress)("{$method} " . ($endpointTemplate ?? '(endpoint not declared)')
                . " sending (attempt {$attempt}/{$this->retryPolicy->maxAttempts})");

            try {
                $raw = $this->connectedClient()->sendRequest($request);
            } catch (ResponseTooLargeException $tooLarge) {
                throw $this->refuseOversizedBody(
                    $this->requestInfo($wire, $requestsSent, $staleEchoResent, $started, $requestInfoHeaders, $requestInfoBody),
                    $tooLarge->cap,
                    $tooLarge->declaredLength,
                    $tooLarge->receivedBytes,
                    true
                );
            } catch (ClientExceptionInterface $exception) {
                $lastException = $exception;
                $retryable = $this->retryPolicy->shouldRetryAfterException($exception, $method);
                if (!$this->retryAfterFailure($exception, $retryable, $attempt, $replayable, $bodyStream)) {
                    break;
                }
                continue;
            }

            $status = $raw->getStatusCode();
            if ($attempt < $this->retryPolicy->maxAttempts
                && $replayable
                && $this->retryPolicy->shouldRetryStatusCode($status, $method)
                && self::rewind($bodyStream)) {
                $delay = $this->retryPolicy->computeBackoffSeconds($attempt, $raw->getHeaderLine('Retry-After') ?: null);
                ($this->onProgress)("{$status}; retrying in " . round($delay, 1) . 's');
                $raw->getBody()->close();
                self::sleep($delay);
                continue;
            }

            $requestInfo = $this->requestInfo($wire, $requestsSent, $staleEchoResent, $started, $requestInfoHeaders, $requestInfoBody);
            try {
                $body = $this->readBodyWithinTheCap($raw, $requestInfo);
            } catch (SdkError $refusal) {
                throw $refusal;
            } catch (\Exception $failure) {
                $lastException = $failure;
                $retryable = $this->retryPolicy->shouldRetryAfterResponseBodyFailure($method);
                if (!$this->retryAfterFailure($failure, $retryable, $attempt, $replayable, $bodyStream)) {
                    break;
                }
                continue;
            }
            $apiResponse = $this->buildApiResponse(
                $raw,
                $body,
                $requestInfo,
                $responseFormat ?? $this->config->responseFormat,
                $dtoType
            );

            if (!$staleEchoResent
                && $replayable
                && in_array($method, RetryPolicy::SAFE_METHODS, true)
                && $this->detectStaleParameterEcho($apiResponse, $params)
                && self::rewind($bodyStream)) {
                $staleEchoResent = true;
                $attempt--;
                $this->discardPooledConnections();
                continue;
            }

            return $apiResponse;
        }

        throw $this->buildTransportError(
            $lastException,
            $this->requestInfo($wire, $requestsSent, $staleEchoResent, $started, $requestInfoHeaders, $requestInfoBody),
        );
    }

    /** Backs off and rewinds for another attempt; false when the attempt may not be repeated. */
    private function retryAfterFailure(
        \Throwable $failure,
        bool $retryable,
        int $attempt,
        bool $replayable,
        ?StreamInterface $bodyStream,
    ): bool {
        if ($attempt >= $this->retryPolicy->maxAttempts || !$replayable || !$retryable || !self::rewind($bodyStream)) {
            return false;
        }
        $delay = $this->retryPolicy->computeBackoffSeconds($attempt);
        ($this->onProgress)(get_class($failure) . '; retrying in ' . round($delay, 1) . 's');
        self::sleep($delay);
        return true;
    }

    /** Release the HTTP client, and with it the idle keep-alive sockets it was holding. */
    public function closeTransport(): void
    {
        $this->httpClient = null;
    }

    /** The client to send on, or a usage error naming the close that released it. */
    private function connectedClient(): ClientInterface
    {
        if ($this->httpClient === null) {
            throw new SdkUsageError(
                'transport is closed: closeTransport() has already released the connection pool, '
                . 'so this request was not sent; build a new Transport to keep talking to the store'
            );
        }
        return $this->httpClient;
    }

    private function grantedAttempts(bool $staleEchoResent): int
    {
        return $this->retryPolicy->maxAttempts + ($staleEchoResent ? 1 : 0);
    }

    private static function requireBodyOwnedMediaType(string $callerType, string $materialisedType): void
    {
        $ownBoundary = self::boundaryParameter($materialisedType);
        $parsed = self::parseMediaType($callerType);
        if ($parsed !== null) {
            [$mediaType, $parameters] = $parsed;
            if ($mediaType === self::MULTIPART_MEDIA_TYPE
                && count($parameters) === 1
                && $parameters[0][0] === 'boundary'
                && $parameters[0][1] === $ownBoundary) {
                return;
            }
        }
        throw new SdkUsageError(
            "headers: Content-Type conflicts with the multipart body's own boundary; drop it"
        );
    }

    /** @return array{string,list<array{string,string}>}|null */
    private static function parseMediaType(string $raw): ?array
    {
        $segments = explode(';', $raw);
        $mediaType = strtolower(trim((string) array_shift($segments)));
        if ($mediaType === '') {
            return null;
        }
        $parameters = [];
        foreach ($segments as $segment) {
            $segment = trim($segment);
            if ($segment === '') {
                return null;
            }
            $equals = strpos($segment, '=');
            if ($equals === false || $equals === 0) {
                return null;
            }
            $name = strtolower(trim(substr($segment, 0, $equals)));
            $value = trim(substr($segment, $equals + 1));
            if (str_starts_with($value, '"')) {
                if (strlen($value) < 2 || !str_ends_with($value, '"')) {
                    return null;
                }
                $value = substr($value, 1, -1);
            }
            $parameters[] = [$name, $value];
        }
        return [$mediaType, $parameters];
    }

    private static function boundaryParameter(string $contentType): ?string
    {
        $parsed = self::parseMediaType($contentType);
        if ($parsed === null) {
            return null;
        }
        foreach ($parsed[1] as [$name, $value]) {
            if ($name === 'boundary' && $value !== '') {
                return $value;
            }
        }
        return null;
    }

    /** @return array{StreamInterface|null,string|null} */
    private function buildBody(#[\SensitiveParameter] mixed $jsonBody, #[\SensitiveParameter] mixed $formData, #[\SensitiveParameter] mixed $files): array
    {
        $startedNs = hrtime(true);
        if ($jsonBody !== null) {
            $encoded = is_string($jsonBody) ? $jsonBody : self::encodeJson($jsonBody);
            $this->requireWithinCeiling('jsonBody', strlen($encoded), $this->config->maxRequestSourceBytes, 'maxRequestSourceBytes');
            $this->requireWithinCeiling('the request body', strlen($encoded), $this->config->maxRequestBytes, 'maxRequestBytes');
            return [$this->streamFactory->createStream($encoded), 'application/json'];
        }
        if ($files !== null) {
            $elements = [];
            $sourceBytes = 0;
            foreach (self::normalizePairs($formData) as [$name, $value]) {
                $elements[] = [
                    'name' => self::escapeMultipartLabel($name),
                    'contents' => $this->materialisePartContents($value, $sourceBytes, $startedNs),
                ];
            }
            foreach (self::normalizePairs($files) as [$name, $value]) {
                $elements[] = $this->multipartFileElement($name, $value, $sourceBytes, $startedNs);
            }
            $boundary = $this->chooseMultipartBoundary($elements, $startedNs);
            $stream = new MultipartStream($elements, $boundary);
            $total = $stream->getSize();
            if ($total === null) {
                throw new SdkUsageError(
                    'files: the multipart body could not report its own length, so it cannot be held '
                    . 'to maxRequestBytes and was not sent'
                );
            }
            $this->requireWithinCeiling(
                'the multipart framing (part headers, delimiters and CRLFs)',
                max(0, $total - $sourceBytes),
                $this->config->maxMultipartOverheadBytes,
                'maxMultipartOverheadBytes'
            );
            $this->requireWithinCeiling('the request body', $total, $this->config->maxRequestBytes, 'maxRequestBytes');
            return [$stream, 'multipart/form-data; boundary=' . $stream->getBoundary()];
        }
        if ($formData !== null) {
            $this->requireWithinCeiling('formData', self::formSourceBytes($formData), $this->config->maxRequestSourceBytes, 'maxRequestSourceBytes');
            $encoded = is_string($formData) ? $formData : http_build_query($formData);
            $this->requireWithinCeiling('the request body', strlen($encoded), $this->config->maxRequestBytes, 'maxRequestBytes');
            return [$this->streamFactory->createStream($encoded), 'application/x-www-form-urlencoded'];
        }
        return [null, null];
    }

    /** @param list<array<string,mixed>> $elements */
    private function chooseMultipartBoundary(array $elements, int $startedNs): string
    {
        for ($attempt = 1; $attempt <= self::BOUNDARY_ATTEMPTS; $attempt++) {
            $boundary = bin2hex(random_bytes(20));
            if (!$this->multipartDelimiterAppears($boundary, $elements, $startedNs)) {
                return $boundary;
            }
        }
        throw new SdkError(
            'could not generate a unique multipart boundary; nothing was sent',
            errorType: ErrorType::Unknown,
        );
    }

    /** Overlap of len-1 bytes catches a delimiter split across chunks.
     *  @param list<array<string,mixed>> $elements */
    private function multipartDelimiterAppears(string $boundary, array $elements, int $startedNs): bool
    {
        foreach ($elements as $element) {
            foreach (['name', 'filename'] as $label) {
                if (is_string($element[$label] ?? null) && str_contains($element[$label], $boundary)) {
                    return true;
                }
            }
            foreach ($element['headers'] ?? [] as $name => $value) {
                if (str_contains((string) $name, $boundary) || str_contains((string) $value, $boundary)) {
                    return true;
                }
            }
            $contents = $element['contents'] ?? null;
            if (is_string($contents)) {
                if (str_contains($contents, $boundary)) {
                    return true;
                }
                continue;
            }
            if ($contents instanceof StreamInterface && $this->delimiterInStream($contents, $boundary, $startedNs)) {
                return true;
            }
        }
        return false;
    }

    private function delimiterInStream(StreamInterface $stream, string $boundary, int $startedNs): bool
    {
        $overlap = max(0, strlen($boundary) - 1);
        $carry = '';
        $stream->rewind();
        try {
            while (!$stream->eof()) {
                $this->requirePreparationTime($startedNs);
                $chunk = $stream->read(self::CHUNK_BYTES);
                if ($chunk === '') {
                    break;
                }
                $window = $carry . $chunk;
                if (str_contains($window, $boundary)) {
                    return true;
                }
                $carry = $overlap > 0 ? substr($window, -$overlap) : '';
            }
        } finally {
            $stream->rewind();
        }
        return false;
    }

    /** The caller's own bytes in a URL-encoded form, before percent-encoding. */
    private static function formSourceBytes(#[\SensitiveParameter] mixed $formData): int
    {
        if (is_string($formData)) {
            return strlen($formData);
        }
        $bytes = 0;
        foreach (self::normalizePairs($formData) as [$name, $value]) {
            $bytes += strlen($name) + strlen(is_array($value) ? (string) json_encode($value) : (string) $value);
        }
        return $bytes;
    }

    private function requireWithinCeiling(string $what, int $measured, int $ceiling, string $setting): void
    {
        if ($measured <= $ceiling) {
            return;
        }
        throw new SdkUsageError(
            "{$what} is {$measured} bytes, over the {$ceiling}-byte {$setting} ceiling, so the request "
            . "was not sent - raise {$setting} on the client if a request this large is expected"
        );
    }

    private function requirePreparationTime(int $startedNs): void
    {
        $budget = $this->config->timeoutSeconds;
        if ((hrtime(true) - $startedNs) / 1_000_000_000 <= $budget) {
            return;
        }
        throw new SdkError(
            "building the request body took longer than the {$budget}s timeoutSeconds budget, so it "
            . 'was abandoned before anything was sent - raise timeoutSeconds, or hand over a source '
            . 'that can be read in that time',
            errorType: ErrorType::Timeout,
        );
    }

    /** Resolve every form value to the text that will be sent. */
    public static function freezeFormPayload(#[\SensitiveParameter] mixed $formData): mixed
    {
        if ($formData === null || is_scalar($formData)) {
            return $formData;
        }
        if (is_array($formData)) {
            $frozen = [];
            foreach ($formData as $name => $value) {
                $frozen[$name] = self::freezeFormPayload($value);
            }
            return $frozen;
        }
        if ($formData instanceof StreamInterface || is_resource($formData)) {
            // streams are copied in buildBody(); reading here would consume them
            return $formData;
        }
        if (method_exists($formData, '__toString')) {
            return (string) $formData;
        }
        return $formData;
    }

    /** @return list<array{string,mixed}> */
    private static function normalizePairs(mixed $payload): array
    {
        if ($payload === null) {
            return [];
        }
        if (is_array($payload)) {
            if (array_is_list($payload) && $payload !== [] && is_array($payload[0]) && count($payload[0]) === 2) {
                return array_map(static fn (array $p): array => [(string) array_values($p)[0], array_values($p)[1]], $payload);
            }
            $pairs = [];
            foreach ($payload as $name => $value) {
                $pairs[] = [(string) $name, $value];
            }
            return $pairs;
        }
        return [];
    }

    /** @return array{name:string,contents:mixed,filename?:string,headers?:array<string,string>} */
    private function multipartFileElement(string $name, mixed $value, int &$sourceBytes, int $startedNs): array
    {
        if (is_array($value)) {
            $values = array_values($value);
            $element = [
                'name' => self::escapeMultipartLabel($name),
                'contents' => $this->materialisePartContents($values[1] ?? '', $sourceBytes, $startedNs),
                'filename' => self::escapeMultipartLabel(is_string($values[0] ?? null) ? $values[0] : $name),
            ];
            if (isset($values[2]) && is_string($values[2])) {
                $element['headers'] = ['Content-Type' => $values[2]];
            }
            return $element;
        }
        return [
            'name' => self::escapeMultipartLabel($name),
            'contents' => $this->materialisePartContents($value, $sourceBytes, $startedNs),
            'filename' => self::escapeMultipartLabel($name),
        ];
    }

    public static function refuseUnsendableMultipartLabels(
        #[\SensitiveParameter] mixed $files,
        #[\SensitiveParameter] mixed $formData,
    ): void {
        if ($files === null) {
            return;
        }
        foreach (self::normalizePairs($formData) as [$name, $_]) {
            self::refuseMultipartHeaderBytes('field name', $name, $name);
        }
        foreach (self::normalizePairs($files) as [$name, $value]) {
            self::refuseMultipartHeaderBytes('field name', $name, $name);
            if (!is_array($value)) {
                continue;
            }
            $values = array_values($value);
            if (is_string($values[0] ?? null)) {
                self::refuseMultipartHeaderBytes('filename', $values[0], $name);
            }
            if (is_string($values[2] ?? null)) {
                self::refuseMultipartHeaderBytes('Content-Type', $values[2], $name);
            }
        }
    }

    private static function refuseMultipartHeaderBytes(
        string $label,
        #[\SensitiveParameter] string $value,
        string $fieldName,
    ): void {
        foreach (self::MULTIPART_FORBIDDEN_BYTES as $named => $byte) {
            $offset = strpos($value, $byte);
            if ($offset === false) {
                continue;
            }
            throw new SdkUsageError(
                "multipart {$label} for field '" . self::printableHeaderName($fieldName) . "' contains "
                . "{$named} at byte offset {$offset}; strip it"
            );
        }
    }

    /** Percent-escape `\` and `"` in a part label. */
    private static function escapeMultipartLabel(string $label): string
    {
        return str_replace(['\\', '"'], ['%5C', '%22'], $label);
    }

    /** Copied: MultipartStream would fclose() the caller's handle. */
    private function materialisePartContents(mixed $value, int &$sourceBytes, int $startedNs): mixed
    {
        if (is_resource($value)) {
            return $this->spool(
                static fn (): bool => feof($value),
                static function (int $length) use ($value): string {
                    $chunk = fread($value, $length);
                    if ($chunk === false) {
                        throw new SdkUsageError(
                            'files: a supplied resource could not be read, so the request body could not be '
                            . 'built; check the handle is still open and readable'
                        );
                    }
                    return $chunk;
                },
                $sourceBytes,
                $startedNs,
            );
        }
        if ($value instanceof StreamInterface) {
            return $this->spool($value->eof(...), $value->read(...), $sourceBytes, $startedNs);
        }
        $text = (string) $value;
        $sourceBytes += strlen($text);
        $this->requireWithinCeiling(
            'the request payload',
            $sourceBytes,
            $this->config->maxRequestSourceBytes,
            'maxRequestSourceBytes'
        );
        return $text;
    }

    /** A bounded copy from where the caller left the source, which is never closed or rewound.
     *  @param Closure(): bool $eof
     *  @param Closure(int): string $read */
    private function spool(Closure $eof, Closure $read, int &$sourceBytes, int $startedNs): StreamInterface
    {
        $spool = GuzzleClientFactory::newSpool();
        $copied = 0;
        while (!$eof()) {
            $this->requirePreparationTime($startedNs);
            $chunk = $read($this->nextSpoolRead($copied, $sourceBytes));
            if ($chunk === '') {
                break;
            }
            $copied += strlen($chunk);
            $this->requireSpoolWithinCeilings($copied, $sourceBytes + $copied);
            $spool->write($chunk);
        }
        $sourceBytes += $copied;
        $spool->rewind();
        return $spool;
    }

    /** What either ceiling has left, plus the one byte that proves the source went past it. */
    private function nextSpoolRead(int $copied, int $sourceBytes): int
    {
        $remaining = min(
            $this->config->maxSpoolBytes - $copied,
            $this->config->maxRequestSourceBytes - ($sourceBytes + $copied),
        );
        return max(1, min(self::CHUNK_BYTES, $remaining + 1));
    }

    private function requireSpoolWithinCeilings(int $copied, int $aggregate): void
    {
        $this->requireWithinCeiling('a supplied stream', $copied, $this->config->maxSpoolBytes, 'maxSpoolBytes');
        $this->requireWithinCeiling('the request payload', $aggregate, $this->config->maxRequestSourceBytes, 'maxRequestSourceBytes');
    }

    /** @param array{method:string,url:string,params:array<string,mixed>|null,endpointTemplate:string|null} $wire
     *  @param array<string,string>|null $requestInfoHeaders */
    private function requestInfo(
        #[\SensitiveParameter] array $wire,
        int $requestsSent,
        bool $staleEchoResent,
        int $started,
        #[\SensitiveParameter] ?array $requestInfoHeaders,
        #[\SensitiveParameter] mixed $requestInfoBody,
    ): RequestInfo {
        return new RequestInfo(
            clientName: $this->config->clientName(),
            apiVersion: $this->config->apiVersion,
            httpMethod: $wire['method'],
            url: $wire['url'],
            queryParams: $wire['params'] ?? [],
            body: $requestInfoBody,
            headers: $requestInfoHeaders ?? [],
            attemptCount: $requestsSent,
            maxAttempts: $this->grantedAttempts($staleEchoResent),
            elapsedSeconds: self::elapsed($started),
            endpointTemplate: $wire['endpointTemplate'],
        );
    }

    private function readBodyWithinTheCap(ResponseInterface $raw, RequestInfo $requestInfo): string
    {
        $cap = $this->config->maxResponseBytes;
        $declaredHeader = $raw->getHeaderLine('Content-Length');
        $declared = $declaredHeader !== '' && ctype_digit($declaredHeader) ? (int) $declaredHeader : null;
        if ($declared !== null && $declared > $cap) {
            $raw->getBody()->close();
            throw $this->refuseOversizedBody($requestInfo, $cap, $declared);
        }
        $stream = $raw->getBody();
        $body = '';
        while (!$stream->eof()) {
            $chunk = $stream->read(max(1, min(self::CHUNK_BYTES, $cap - strlen($body) + 1)));
            if ($chunk === '') {
                break;
            }
            $body .= $chunk;
            if (strlen($body) > $cap) {
                $stream->close();
                throw $this->refuseOversizedBody($requestInfo, $cap, $declared);
            }
        }
        return $body;
    }

    private function refuseOversizedBody(
        RequestInfo $requestInfo,
        int $cap,
        ?int $declared,
        ?int $receivedBytes = null,
        bool $stoppedInFlight = false,
    ): SdkError {
        $size = $declared !== null ? " (Content-Length {$declared})" : '';
        $outcome = $stoppedInFlight
            ? ($declared !== null
                ? 'so the transfer was abandoned before the body was downloaded'
                : "so the transfer was stopped after {$receivedBytes} byte(s)")
            : 'so it was not read into a string. The response had already been received by '
                . 'the HTTP client, which is where an injected client decides that';
        return new SdkError(
            "the response body is over the {$cap}-byte maxResponseBytes cap{$size}, "
            . "{$outcome} - raise "
            . 'maxResponseBytes on the client if a body this large is expected',
            errorType: ErrorType::Unknown,
            requestInfo: $requestInfo,
            // not chained: a cause's trace would expose the bearer token
        );
    }

    /** @param class-string<Dto>|(Closure(array<string,mixed>): Dto)|null $dtoType */
    private function buildApiResponse(
        ResponseInterface $raw,
        string $body,
        RequestInfo $requestInfo,
        string $responseFormat,
        string|Closure|null $dtoType,
    ): ApiResponse {
        $contentType = $raw->getHeaderLine('Content-Type');
        $status = $raw->getStatusCode();
        return new ApiResponse(
            statusCode: $status,
            data: self::decodeBodyText($body, $status, $contentType),
            headers: self::flattenHeaders($raw),
            contentType: $contentType ?: null,
            bodyText: self::bodyTextOrNull($body, $status, $contentType),
            responseFormat: $responseFormat,
            dtoType: $dtoType,
            requestInfo: $requestInfo,
        );
    }

    private function buildTransportError(
        #[\SensitiveParameter] \Throwable $exception,
        RequestInfo $requestInfo,
    ): SdkError {
        $timedOut = RetryPolicy::isTimeout($exception);
        $label = $timedOut ? 'timed out' : 'failed';
        $cause = get_class($exception);
        return new SdkError(
            "the request {$label} after {$requestInfo->attemptCount} attempt(s) ({$cause}); the HTTP client's own "
            . "message names the resolved URL, so it is on getErrorMessages() rather than here",
            errorType: $timedOut ? ErrorType::Timeout : ErrorType::Network,
            requestInfo: $requestInfo,
            errors: [Redaction::redactText($exception->getMessage())],
        );
    }

    /** @param array<string,mixed>|null $params */
    private function detectStaleParameterEcho(
        ApiResponse $response,
        #[\SensitiveParameter] ?array $params,
    ): bool {
        // `map`, never `data`: `data` follows the caller's responseFormat.
        if ($response->statusCode !== 400 || !is_array($response->map)) {
            return false;
        }
        $named = self::extractErrorFields($response->map);
        if ($named === [] && ($response->map['error'] ?? null) === self::UNKNOWN_PARAMETER_ERROR) {
            $named = self::parseUnknownParameterMessage($response->map);
        }
        if ($named === []) {
            return false;
        }
        $sent = array_map(static fn ($n): string => strtolower((string) $n), array_keys($params ?? []));
        if ($sent === []) {
            return false;
        }
        return array_intersect($named, $sent) === [];
    }

    /** @param array<string,mixed> $body
     *  @return list<string> */
    private static function extractErrorFields(array $body): array
    {
        $entries = $body['errors'] ?? null;
        if (!is_array($entries)) {
            return [];
        }
        $fields = [];
        if (array_is_list($entries)) {
            foreach ($entries as $entry) {
                if (is_array($entry) && isset($entry['field']) && $entry['field'] !== '') {
                    $fields[] = strtolower(trim((string) $entry['field']));
                }
            }
        } else {
            foreach (array_keys($entries) as $fieldName) {
                $fields[] = strtolower(trim((string) $fieldName));
            }
        }
        return array_values(array_unique(array_filter($fields, static fn (string $n): bool => $n !== '')));
    }

    /** The fallback for an `unknown_parameter` body carrying no `errors[]`.
     *  @param array<string,mixed> $body
     *  @return list<string> */
    private static function parseUnknownParameterMessage(array $body): array
    {
        $message = (string) ($body['message'] ?? '');
        $marker = 'unknown query parameter(s):';
        $pos = stripos($message, $marker);
        if ($pos === false) {
            return [];
        }
        $fields = [];
        foreach (explode(',', substr($message, $pos + strlen($marker))) as $item) {
            if (preg_match('/[A-Za-z0-9_-]+/', $item, $m) === 1) {
                $fields[] = strtolower($m[0]);
            }
        }
        return array_values(array_unique($fields));
    }

    private function discardPooledConnections(): void
    {
        if ($this->ownsClient) {
            $this->httpClient = GuzzleClientFactory::create($this->config);
        }
    }

    public static function decodeBodyText(string $body, int $statusCode, string $rawContentType): mixed
    {
        if ($statusCode === 204 || $body === '') {
            return null;
        }
        $contentType = strtolower($rawContentType);
        if (self::isJsonMediaType($contentType)) {
            $decoded = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
            $stripped = str_starts_with($body, "\xEF\xBB\xBF") ? substr($body, 3) : $body;
            $decoded = json_decode($stripped, true);
            return json_last_error() === JSON_ERROR_NONE ? $decoded : $body;
        }
        if (str_starts_with($contentType, 'text/')) {
            return self::decodeText($body, $contentType);
        }
        return $body;
    }

    /** The body text for `$response->json`, or null when there is none to give. */
    public static function bodyTextOrNull(string $body, int $statusCode, string $rawContentType): ?string
    {
        if ($statusCode === 204 || $body === '') {
            return null;
        }
        $contentType = strtolower($rawContentType);
        if (self::isJsonMediaType($contentType)) {
            return $body;
        }
        if (str_starts_with($contentType, 'text/')) {
            return self::decodeText($body, $contentType);
        }
        return null;
    }

    /** RFC 6839 structured suffixes included, so `application/problem+json` decodes. */
    private static function isJsonMediaType(string $contentType): bool
    {
        $mediaType = trim(explode(';', $contentType, 2)[0]);
        return $mediaType === 'application/json' || str_ends_with($mediaType, '+json');
    }

    private static function decodeText(string $body, string $contentType): string
    {
        if (str_contains($contentType, 'charset=')) {
            $charset = trim(substr($contentType, strpos($contentType, 'charset=') + 8));
            $charset = trim(explode(';', $charset)[0], " \"'");
            if ($charset !== '' && strcasecmp($charset, 'utf-8') !== 0
                && in_array(strtolower($charset), array_map('strtolower', mb_list_encodings()), true)) {
                $converted = @mb_convert_encoding($body, 'UTF-8', $charset);
                if ($converted !== false) {
                    return $converted;
                }
            }
        }
        if (mb_check_encoding($body, 'UTF-8')) {
            return $body;
        }
        return mb_convert_encoding($body, 'UTF-8', 'ISO-8859-1');
    }

    /** @return array<string,string> */
    private static function flattenHeaders(ResponseInterface $raw): array
    {
        $out = [];
        foreach ($raw->getHeaders() as $name => $values) {
            $out[$name] = implode(', ', $values);
        }
        return $out;
    }

    private static function rewind(?StreamInterface $stream): bool
    {
        if ($stream === null) {
            return true;
        }
        if (!$stream->isSeekable()) {
            return false;
        }
        try {
            $stream->rewind();
            return true;
        } catch (\RuntimeException) {
            return false;
        }
    }

    private static function sleep(float $seconds): void
    {
        if ($seconds > 0) {
            usleep((int) ($seconds * 1_000_000));
        }
    }

    private static function elapsed(int $startedNs): float
    {
        return round((hrtime(true) - $startedNs) / 1_000_000_000, 4);
    }

    /** @param array<string,mixed>|null $params */
    private static function mergeQuery(
        #[\SensitiveParameter] string $url,
        #[\SensitiveParameter] ?array $params,
    ): string {
        UrlBuilder::rejectFragment('url', $url);
        $query = $params ? self::encodeQuery($params) : '';
        if ($query === '') {
            return $url;
        }
        return $url . (str_contains($url, '?') ? '&' : '?') . $query;
    }

    /** The query string as sent; a list value repeats its key.
     *  @param array<string,mixed> $params */
    public static function encodeQuery(#[\SensitiveParameter] array $params): string
    {
        $pairs = [];
        foreach ($params as $key => $value) {
            foreach (is_array($value) ? $value : [$value] as $item) {
                $pairs[] = rawurlencode((string) $key) . '=' . rawurlencode(self::scalar($item));
            }
        }
        return implode('&', $pairs);
    }

    public static function encodeJson(#[\SensitiveParameter] mixed $value): string
    {
        $encoded = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($encoded === false) {
            throw new SdkUsageError('jsonBody is not JSON-serialisable: ' . json_last_error_msg());
        }
        return $encoded;
    }

    private static function scalar(mixed $value): string
    {
        return is_bool($value) ? ($value ? 'true' : 'false') : (string) $value;
    }

    /** Extension methods pass; {@see RetryPolicy} treats an unfamiliar one as unsafe. */
    private static function normalizeMethod(string $httpMethod): string
    {
        $method = strtoupper(trim($httpMethod));
        if ($method === '') {
            throw new SdkUsageError("httpMethod: expected a non-blank string like 'GET'");
        }
        if (!RetryPolicy::isMethodToken($method)) {
            throw new SdkUsageError(
                "httpMethod: '" . self::printableHeaderName($httpMethod) . "' is not a method - "
                . 'RFC 9110 allows only the token character set, so a space, a colon, a control '
                . 'byte and every non-ASCII byte are all outside it'
            );
        }
        return $method;
    }

    /** Which half of a header this SDK cannot send, or null when both are sendable.
     *  @return 'name'|'value'|null */
    public static function headerProblem(string $name, #[\SensitiveParameter] string $value): ?string
    {
        if (preg_match(self::TOKEN_PATTERN, $name) !== 1) {
            return 'name';
        }
        return preg_match(self::HEADER_VALUE_PATTERN, $value) === 1 ? null : 'value';
    }

    /** A header name as it may appear in a refusal message: every byte outside printable
     *  ASCII becomes `?`, so a raw CR cannot forge a line in the log that receives it. */
    public static function printableHeaderName(string $name): string
    {
        return (string) preg_replace('/[^\x20-\x7E]/', '?', $name);
    }

    /** Refuse a header this SDK cannot send as the caller wrote it.
     *  @param array<string,string>|null $headers */
    public static function refuseUnsendableHeaders(#[\SensitiveParameter] ?array $headers): void
    {
        foreach ($headers ?? [] as $name => $value) {
            $name = (string) $name;
            if (self::headerProblem($name, (string) $value) === null) {
                continue;
            }
            throw new SdkUsageError(
                "header '" . self::printableHeaderName($name) . "': not a sendable name or value; the value is not shown"
            );
        }
    }
}
