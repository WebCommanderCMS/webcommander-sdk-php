<?php

declare(strict_types=1);

namespace WebCommander\Client;

use Closure;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;
use WebCommander\Auth\FileTokenStore;
use WebCommander\Auth\MemoryTokenStore;
use WebCommander\Auth\TokenCache;
use WebCommander\Auth\TokenProvider;
use WebCommander\Auth\TokenStore;
use WebCommander\Config\SdkConfig;
use WebCommander\Errors\InsecureTransportWarning;
use WebCommander\Errors\SdkError;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Http\QueryParams;
use WebCommander\Http\RetryPolicy;
use WebCommander\Http\Transport;
use WebCommander\Http\UrlBuilder;
use WebCommander\Redaction;

/** The client: config in, ApiResponse out. Each registered resource is a property.
 *  @property-read BoundResource $adminCustomers see AdminCustomers
 *  @property-read BoundResource $aliases see Aliases
 *  @property-read BoundResource $animationEffects see AnimationEffects
 *  @property-read BoundResource $blogCategories see BlogCategories
 *  @property-read BoundResource $blogs see Blogs
 *  @property-read BoundResource $carts see Carts
 *  @property-read BoundResource $categories see Categories
 *  @property-read BoundResource $categoryPage see CategoryPage
 *  @property-read BoundResource $checkoutPage see CheckoutPage
 *  @property-read BoundResource $cities see Cities
 *  @property-read BoundResource $commonSettings see CommonSettings
 *  @property-read BoundResource $countries see Countries
 *  @property-read BoundResource $currencies see Currencies
 *  @property-read BoundResource $customerGroups see CustomerGroups
 *  @property-read BoundResource $customerPortal see CustomerPortal
 *  @property-read BoundResource $discountProfiles see DiscountProfiles
 *  @property-read BoundResource $ecommerceSettings see EcommerceSettings
 *  @property-read BoundResource $email see Email
 *  @property-read BoundResource $inventoryLocations see InventoryLocations
 *  @property-read BoundResource $orderCustomFields see OrderCustomFields
 *  @property-read BoundResource $orderFlags see OrderFlags
 *  @property-read BoundResource $orders see Orders
 *  @property-read BoundResource $pages see Pages
 *  @property-read BoundResource $paymentGateways see PaymentGateways
 *  @property-read BoundResource $priceDisplaySettings see PriceDisplaySettings
 *  @property-read BoundResource $productListing see ProductListing
 *  @property-read BoundResource $productPage see ProductPage
 *  @property-read BoundResource $products see Products
 *  @property-read BoundResource $searchResultPage see SearchResultPage
 *  @property-read BoundResource $searchSettings see SearchSettings
 *  @property-read BoundResource $seoConfiguration see SeoConfiguration
 *  @property-read BoundResource $shippingClasses see ShippingClasses
 *  @property-read BoundResource $shippingMethods see ShippingMethods
 *  @property-read BoundResource $shippingSettings see ShippingSettings
 *  @property-read BoundResource $shoppingCart see ShoppingCart
 *  @property-read BoundResource $siteSettings see SiteSettings
 *  @property-read BoundResource $taxCodes see TaxCodes
 *  @property-read BoundResource $taxCountryTaxes see TaxCountryTaxes
 *  @property-read BoundResource $taxCustomProfiles see TaxCustomProfiles
 *  @property-read BoundResource $taxProfiles see TaxProfiles
 *  @property-read BoundResource $taxRules see TaxRules
 *  @property-read BoundResource $taxSettings see TaxSettings
 *  @property-read BoundResource $taxZones see TaxZones
 *  @property-read BoundResource $transactions see Transactions
 *  @property-read BoundResource $trash see Trash
 *  @property-read BoundResource $variations see Variations */
final class WebCommanderClient
{
    private const API_VERSION_PARAM = 'api_version';
    private const TOKEN_FAILURE_ERROR = 'unauthorized';
    private const TOKEN_FAILURE_MESSAGES = ['invalid_access_token', 'invalid_request'];
    private const LOOPBACK_HOSTNAMES = ['localhost', 'localhost.localdomain'];

    private readonly Transport $transport;
    private readonly TokenStore $tokenStore;
    private readonly TokenProvider $tokenProvider;
    private readonly LoggerInterface $logger;
    private readonly bool $ownsTransport;
    /** @var array<string,BoundResource> */
    private array $resources = [];
    private bool $closed = false;

    public function __construct(
        private readonly SdkConfig $config,
        ?TokenStore $tokenStore = null,
        ?Transport $transport = null,
        ?RetryPolicy $retryPolicy = null,
        ?TokenProvider $tokenProvider = null,
        ?LoggerInterface $logger = null,
    ) {
        if ($transport !== null && $retryPolicy !== null) {
            throw new SdkUsageError(
                'pass transport or retryPolicy, not both - an injected transport already carries '
                . 'its own policy; build it into the transport instead'
            );
        }

        $this->logger = $logger ?? ($config->logFile !== null && $config->logFile !== ''
            ? new FileLogger($config->logFile, $config->logLevel)
            : new NullLogger());

        if (!$config->verifySsl) {
            InsecureTransportWarning::emit(
                'TLS verification is disabled (verifySsl: false); responses cannot be trusted',
                $this->logger
            );
        }
        $this->warnAboutPlaintextTransport();

        $this->ownsTransport = $transport === null;
        $this->transport = $transport ?? new Transport(
            $config,
            retryPolicy: $retryPolicy,
            onProgress: fn (string $message): null => $this->reportProgress($message),
        );
        $this->tokenStore = $tokenStore ?? self::buildTokenStore($config);
        $this->tokenProvider = $tokenProvider
            ?? new TokenProvider($config, $this->transport, $this->tokenStore, logger: $this->logger);
    }

    public function __get(string $name): BoundResource
    {
        return $this->resources[$name] ??= new BoundResource($this, ResourceRegistry::resolveResourceModule($name));
    }

    public function config(): SdkConfig
    {
        return $this->config;
    }

    public function name(): string
    {
        return $this->config->clientName();
    }

    /** @return list<string> */
    public function listResourceNames(): array
    {
        return ResourceRegistry::registeredResourceNames();
    }

    /** @param array<string,mixed>|null $pathParams
     *  @param array<string,mixed>|null $queryParams
     *  @param array<string,string>|null $headers
     *  @param string|null $responseFormat `"map"`, `"json"` or `"dto"` for this one call;
     *      null takes the client's setting
     *  @param class-string<Dto>|(Closure(array<string,mixed>): Dto)|null $dtoType */
    public function sendApiRequest(
        string $httpMethod,
        string $path,
        ?array $pathParams = null,
        #[\SensitiveParameter] ?array $queryParams = null,
        #[\SensitiveParameter] mixed $jsonBody = null,
        #[\SensitiveParameter] mixed $formData = null,
        #[\SensitiveParameter] mixed $files = null,
        #[\SensitiveParameter] ?array $headers = null,
        bool $authenticated = true,
        ?bool $raiseOnError = null,
        ?string $responseFormat = null,
        string|Closure|null $dtoType = null,
    ): ApiResponse {
        $this->refuseWhenClosed();
        self::validatePath($path);
        $resolvedFormat = $this->resolveResponseFormat($responseFormat);
        $jsonText = $this->resolveJsonPayload($jsonBody, $formData, $files);
        $headers = self::freezeSendableHeaders($headers);
        $formData = Transport::freezeFormPayload($formData);

        $resolvedPath = UrlBuilder::substitutePathParams($path, $this->seedApiVersion($path, $pathParams));
        $url = UrlBuilder::buildUrl($this->config->baseUrl(), $resolvedPath);
        $params = QueryParams::build($queryParams);
        $this->rejectDuplicatedQueryParams($url, $params);

        $wire = $this->transport->materializeRequest(
            $httpMethod,
            $url,
            $params,
            jsonBody: $jsonText,
            formData: $formData,
            files: $files,
            endpointTemplate: $path,
        );
        $method = $wire['method'];

        $reportedBody = $jsonText ?? $formData;
        $reportedFiles = Console::freezeMultipartLabels($files);
        $formEncoded = $jsonText === null && $formData !== null;
        $reportedPayload = Redaction::redactValue(Console::summarisePayload($reportedBody, $reportedFiles));

        $accessToken = $authenticated ? $this->tokenProvider->getAccessToken() : null;

        $sendOnce = function (?string $token) use ($wire, $reportedFiles, $headers, $reportedBody, $reportedPayload, $formEncoded, $resolvedFormat, $dtoType): ApiResponse {
            $requestHeaders = $this->buildRequestHeaders($headers, $token);
            try {
                return $this->transport->sendMaterializedRequest(
                    $wire,
                    $requestHeaders,
                    Redaction::redactMapping($requestHeaders),
                    $reportedPayload,
                    $resolvedFormat,
                    $dtoType,
                );
            } catch (SdkError $error) {
                if ($error->requestInfo instanceof RequestInfo) {
                    $this->reportExchange(new FailedExchange($error->requestInfo), $reportedBody, $reportedFiles, LogLevel::ERROR, $formEncoded);
                }
                throw $error;
            }
        };

        $response = $sendOnce($accessToken);

        if ($authenticated && self::meansExpiredToken($response, $method)
            && Transport::rewindMaterializedBody($wire)) {
            $this->reportExchange($response, $reportedBody, $reportedFiles, LogLevel::WARNING, $formEncoded);
            $response = $sendOnce($this->tokenProvider->refreshAccessToken($accessToken));
        }

        $this->reportExchange($response, $reportedBody, $reportedFiles, LogLevel::INFO, $formEncoded);

        $shouldRaise = $raiseOnError ?? $this->config->raiseOnError;
        if ($shouldRaise) {
            $response->raiseForStatus();
        }
        return $response;
    }

    public function sendGetRequest(string $path, ?array $pathParams = null, #[\SensitiveParameter] ?array $queryParams = null, #[\SensitiveParameter] mixed $jsonBody = null, #[\SensitiveParameter] mixed $formData = null, #[\SensitiveParameter] mixed $files = null, #[\SensitiveParameter] ?array $headers = null, bool $authenticated = true, ?bool $raiseOnError = null, ?string $responseFormat = null, string|Closure|null $dtoType = null): ApiResponse
    {
        return $this->sendApiRequest('GET', $path, $pathParams, $queryParams, $jsonBody, $formData, $files, $headers, $authenticated, $raiseOnError, $responseFormat, $dtoType);
    }

    public function sendPostRequest(string $path, ?array $pathParams = null, #[\SensitiveParameter] ?array $queryParams = null, #[\SensitiveParameter] mixed $jsonBody = null, #[\SensitiveParameter] mixed $formData = null, #[\SensitiveParameter] mixed $files = null, #[\SensitiveParameter] ?array $headers = null, bool $authenticated = true, ?bool $raiseOnError = null, ?string $responseFormat = null, string|Closure|null $dtoType = null): ApiResponse
    {
        return $this->sendApiRequest('POST', $path, $pathParams, $queryParams, $jsonBody, $formData, $files, $headers, $authenticated, $raiseOnError, $responseFormat, $dtoType);
    }

    public function sendPutRequest(string $path, ?array $pathParams = null, #[\SensitiveParameter] ?array $queryParams = null, #[\SensitiveParameter] mixed $jsonBody = null, #[\SensitiveParameter] mixed $formData = null, #[\SensitiveParameter] mixed $files = null, #[\SensitiveParameter] ?array $headers = null, bool $authenticated = true, ?bool $raiseOnError = null, ?string $responseFormat = null, string|Closure|null $dtoType = null): ApiResponse
    {
        return $this->sendApiRequest('PUT', $path, $pathParams, $queryParams, $jsonBody, $formData, $files, $headers, $authenticated, $raiseOnError, $responseFormat, $dtoType);
    }

    public function sendPatchRequest(string $path, ?array $pathParams = null, #[\SensitiveParameter] ?array $queryParams = null, #[\SensitiveParameter] mixed $jsonBody = null, #[\SensitiveParameter] mixed $formData = null, #[\SensitiveParameter] mixed $files = null, #[\SensitiveParameter] ?array $headers = null, bool $authenticated = true, ?bool $raiseOnError = null, ?string $responseFormat = null, string|Closure|null $dtoType = null): ApiResponse
    {
        return $this->sendApiRequest('PATCH', $path, $pathParams, $queryParams, $jsonBody, $formData, $files, $headers, $authenticated, $raiseOnError, $responseFormat, $dtoType);
    }

    public function sendDeleteRequest(string $path, ?array $pathParams = null, #[\SensitiveParameter] ?array $queryParams = null, #[\SensitiveParameter] mixed $jsonBody = null, #[\SensitiveParameter] mixed $formData = null, #[\SensitiveParameter] mixed $files = null, #[\SensitiveParameter] ?array $headers = null, bool $authenticated = true, ?bool $raiseOnError = null, ?string $responseFormat = null, string|Closure|null $dtoType = null): ApiResponse
    {
        return $this->sendApiRequest('DELETE', $path, $pathParams, $queryParams, $jsonBody, $formData, $files, $headers, $authenticated, $raiseOnError, $responseFormat, $dtoType);
    }

    /** @param callable(self): mixed $callback run with a client closed however it ends */
    public static function withClient(SdkConfig $config, callable $callback): mixed
    {
        $client = new self($config);
        try {
            return $callback($client);
        } finally {
            $client->closeClient();
        }
    }

    /** Idempotent; every later request-issuing call is refused. */
    public function closeClient(): void
    {
        if ($this->closed) {
            return;
        }
        $this->closed = true;
        try {
            if ($this->ownsTransport) {
                $this->transport->closeTransport();
            }
        } finally {
            if ($this->logger instanceof FileLogger) {
                $this->logger->close();
            }
        }
    }

    private function refuseWhenClosed(): void
    {
        if (!$this->closed) {
            return;
        }
        throw new SdkUsageError(
            "client '{$this->name()}' is closed: closeClient() has already run, so this request "
            . 'was not sent; build a new WebCommanderClient to keep talking to the store'
        );
    }

    private static function buildTokenStore(SdkConfig $config): TokenStore
    {
        $path = $config->tokenCachePath();
        if ($path !== null && $path !== '') {
            return new FileTokenStore(
                $path,
                TokenCache::buildCredentialsNamespace(
                    $config->baseUrl(),
                    $config->clientId(),
                    $config->clientSecret(),
                    $config->authString(),
                    $config->grantType(),
                ),
                $config->maxTokenCacheBytes,
            );
        }
        return new MemoryTokenStore();
    }

    /** @param array<string,mixed>|null $pathParams
     *  @return array<string,mixed> */
    private function seedApiVersion(string $path, ?array $pathParams): array
    {
        $resolved = $pathParams ?? [];
        if (in_array(self::API_VERSION_PARAM, UrlBuilder::findPathParamNames($path), true)
            && !array_key_exists(self::API_VERSION_PARAM, $resolved)) {
            $resolved[self::API_VERSION_PARAM] = $this->config->apiVersion;
        }
        return $resolved;
    }

    /** @param array<string,string>|null $headers
     *  @return array<string,string> */
    private function buildRequestHeaders(#[\SensitiveParameter] ?array $headers, ?string $accessToken): array
    {
        $own = ['Accept' => 'application/json', 'User-Agent' => $this->config->userAgent];
        $merged = [];
        foreach ($own as $name => $value) {
            $merged[strtolower($name)] = [$name, $value];
        }
        foreach ($this->config->defaultHeadersDict() as $name => $value) {
            $merged[strtolower((string) $name)] = [(string) $name, $value];
        }
        foreach ($headers ?? [] as $name => $value) {
            $merged[strtolower((string) $name)] = [(string) $name, $value];
        }
        if ($accessToken !== null && $accessToken !== '') {
            $merged['authorization'] = ['Authorization', "Bearer {$accessToken}"];
        }
        $out = [];
        foreach ($merged as [$name, $value]) {
            $out[$name] = $value;
        }
        return $out;
    }

    /** @param array<string,string>|null $headers
     *  @return array<string,string> validated copy */
    private static function freezeSendableHeaders(#[\SensitiveParameter] ?array $headers): array
    {
        $checked = [];
        foreach ($headers ?? [] as $name => $value) {
            $name = self::headerName($name);
            $checked[$name] = self::headerValue($name, $value);
        }
        Transport::refuseUnsendableHeaders($checked);
        return $checked;
    }

    private static function headerName(mixed $key): string
    {
        if (!is_string($key)) {
            throw new SdkUsageError('headers: a header name must be text, got ' . get_debug_type($key));
        }
        return $key;
    }

    private static function headerValue(string $name, mixed $value): string
    {
        if (!is_string($value)) {
            throw new SdkUsageError("headers: the value for '{$name}' must be text, got " . get_debug_type($value));
        }
        return $value;
    }

    private function resolveJsonPayload(#[\SensitiveParameter] mixed $jsonBody, #[\SensitiveParameter] mixed $formData, #[\SensitiveParameter] mixed $files): ?string
    {
        if ($jsonBody !== null && $formData !== null) {
            throw new SdkUsageError('pass jsonBody or formData, not both - they are different content types');
        }
        if ($jsonBody !== null && $files !== null) {
            throw new SdkUsageError('pass jsonBody or files, not both - a multipart body replaces the JSON one');
        }
        if ($jsonBody === null) {
            return null;
        }
        if ($jsonBody instanceof Dto) {
            $jsonBody = $jsonBody->toMap();
        }
        // Parsed only to verify: the bytes that cross the wire are the caller's own.
        if (is_string($jsonBody)) {
            $decoded = json_decode($jsonBody, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new SdkUsageError('jsonBody: not valid JSON: ' . json_last_error_msg());
            }
            if (!is_array($decoded)) {
                throw new SdkUsageError(
                    'jsonBody: a JSON string must hold an object or an array, got ' . get_debug_type($decoded)
                );
            }
            return $jsonBody;
        }
        if (!is_array($jsonBody)) {
            throw new SdkUsageError('jsonBody must be a JSON string, a mapping, a list or a DTO, got ' . get_debug_type($jsonBody));
        }
        return Transport::encodeJson($jsonBody);
    }

    private function resolveResponseFormat(?string $responseFormat): string
    {
        return $responseFormat === null
            ? $this->config->responseFormat
            : SdkConfig::requireResponseFormat($responseFormat);
    }

    /** @param array<string,mixed> $params */
    private function rejectDuplicatedQueryParams(string $url, array $params): void
    {
        if ($params === []) {
            return;
        }
        $query = parse_url($url, PHP_URL_QUERY);
        if (!is_string($query) || $query === '') {
            return;
        }
        $existing = [];
        foreach (explode('&', $query) as $chunk) {
            $existing[urldecode(explode('=', $chunk, 2)[0])] = true;
        }
        $clash = array_values(array_intersect(array_keys($existing), array_keys($params)));
        if ($clash !== []) {
            sort($clash);
            throw new SdkUsageError(
                'queryParams ' . implode(', ', $clash) . " already appear in the path's own query "
                . 'string, so each would be sent twice with two values - pass them once, in one place'
            );
        }
    }

    private function warnAboutPlaintextTransport(): void
    {
        $parts = parse_url($this->config->baseUrl());
        $scheme = $parts['scheme'] ?? '';
        $host = $parts['host'] ?? '';
        if ($scheme !== 'http' || self::isLoopbackHost($host)) {
            return;
        }
        InsecureTransportWarning::emit(
            "baseUrl uses http://, so every request to {$host} crosses the network in cleartext - "
            . 'the bearer token, and the credentials in the token request itself. Use https:// unless '
            . 'this is a local development instance',
            $this->logger
        );
    }

    private static function isLoopbackHost(string $host): bool
    {
        if ($host === '') {
            return false;
        }
        if (in_array(strtolower($host), self::LOOPBACK_HOSTNAMES, true)) {
            return true;
        }
        $address = trim($host, '[]');
        if (filter_var($address, FILTER_VALIDATE_IP) !== false) {
            return str_starts_with($address, '127.') || $address === '::1';
        }
        return false;
    }

    /** Gated here: an injected PSR-3 logger does not know config.logLevel. */
    private function log(string $level, string $message): void
    {
        $emitted = FileLogger::SEVERITY[strtolower($level)];
        $threshold = FileLogger::SEVERITY[strtolower($this->config->logLevel)];
        if ($emitted < $threshold) {
            return;
        }
        $this->logger->log($level, $message);
    }

    private function reportProgress(string $message): void
    {
        if ($this->config->printApiInfo && !$this->config->printOnlyOnError) {
            echo "| {$message}\n";
        }
        $this->log(LogLevel::INFO, $message);
    }

    private function reportExchange(object $response, mixed $body, #[\SensitiveParameter] mixed $files, string $level = LogLevel::INFO, bool $formEncoded = false): void
    {
        $config = $this->config;
        $wantsPrint = $config->printApiInfo || $config->printRequestPayload || $config->printResponseBody
            || $config->printHeaders || $config->printCurl;
        if ($wantsPrint && !($config->printOnlyOnError && $response->succeeded())) {
            echo Console::renderExchange($response, $body, $files, $config, $formEncoded) . "\n";
        }
        $info = $response->requestInfo;
        $category = $response->errorType ?? null;
        $this->log(
            $level,
            "{$info->httpMethod} " . self::loggedEndpoint($info) . " -> {$response->statusCode}"
            . ($category instanceof ErrorType && $category !== ErrorType::None ? " {$category->value}" : '')
            . " in {$info->elapsedSeconds}s (attempt {$info->attemptCount}/{$info->maxAttempts})"
        );
        if ($config->logBodies) {
            $this->log(
                LogLevel::DEBUG,
                'url=' . $info->url
                . ' payload=' . Console::renderJsonValue(Redaction::redactValue($body), true)
                . ' response=' . Console::renderJsonValue(Redaction::redactValue($response->map), true)
            );
        }
    }

    /** The declared path template, never the resolved URL. */
    private static function loggedEndpoint(RequestInfo $info): string
    {
        $template = $info->endpointTemplate;
        return $template !== null && $template !== '' ? $template : '(endpoint not declared)';
    }

    private static function meansExpiredToken(ApiResponse $response, string $httpMethod): bool
    {
        if ($response->statusCode !== 401) {
            return false;
        }
        // `map`, never `data`: read off the store's own body, not the caller's chosen form.
        $data = $response->map;
        if (!is_array($data)) {
            // No reason to read: a safe method changed nothing, so replaying it is free.
            return RetryPolicy::isSafeMethod($httpMethod);
        }
        if (self::normalisedReason($data['error'] ?? null) === self::TOKEN_FAILURE_ERROR) {
            return true;
        }
        return in_array(self::normalisedReason($data['message'] ?? null), self::TOKEN_FAILURE_MESSAGES, true);
    }

    private static function normalisedReason(mixed $value): string
    {
        return strtolower(trim((string) ($value ?? '')));
    }

    private static function validatePath(string $path): void
    {
        if (trim($path) === '') {
            throw new SdkUsageError("path must name an endpoint, got '{$path}'");
        }
    }
}
