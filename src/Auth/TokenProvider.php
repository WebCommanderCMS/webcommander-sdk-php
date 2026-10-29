<?php

declare(strict_types=1);

namespace WebCommander\Auth;

use Psr\Log\LoggerInterface;
use WebCommander\Client\ApiResponse;
use WebCommander\Config\SdkConfig;
use WebCommander\Errors\SdkAuthError;
use WebCommander\Errors\SdkError;
use WebCommander\Http\Transport;
use WebCommander\Redaction;

final class TokenProvider
{
    private const TOKEN_PATH_TEMPLATE = '/api/{api_version}/oauth2/token';
    private const REFRESH_GRANT_TYPE = 'refresh_token';

    private readonly string $tokenPath;

    public function __construct(
        private readonly SdkConfig $config,
        private readonly Transport $transport,
        private readonly TokenStore $store,
        ?string $tokenPath = null,
        private readonly ?LoggerInterface $logger = null,
    ) {
        $this->tokenPath = $tokenPath ?? str_replace('{api_version}', $config->apiVersion, self::TOKEN_PATH_TEMPLATE);
    }

    public function tokenUrl(): string
    {
        return $this->config->baseUrl() . $this->tokenPath;
    }

    public function getAccessToken(): string
    {
        $record = TokenRecord::fromArray($this->store->readTokenRecord());
        if ($record !== null && !$record->needsRefresh()) {
            return $record->accessToken;
        }
        return $this->renew(null, true);
    }

    public function refreshAccessToken(#[\SensitiveParameter] ?string $staleAccessToken): string
    {
        return $this->renew($staleAccessToken, false);
    }

    private function renew(#[\SensitiveParameter] ?string $staleAccessToken, bool $anyCachedTokenWillDo): string
    {
        $lock = $this->store->acquireTokenRefreshLock();
        try {
            $record = TokenRecord::fromArray($this->store->readTokenRecord());
            if ($record !== null && !$record->needsRefresh()) {
                if ($anyCachedTokenWillDo
                    || ($staleAccessToken !== null && $record->accessToken !== $staleAccessToken)) {
                    return $record->accessToken;
                }
            }

            $newRecord = null;
            if ($record !== null && $record->refreshToken !== null && $record->refreshToken !== '') {
                $newRecord = $this->requestTokenWithRefreshGrant($record->refreshToken);
            }
            if ($newRecord === null) {
                $newRecord = $this->requestTokenWithCredentials();
            }

            try {
                $this->store->writeTokenRecord($newRecord->toArray());
            } catch (SdkError $refused) {
                $this->reportCacheDegradation($refused);
            }
            return $newRecord->accessToken;
        } finally {
            $lock->release();
        }
    }

    private function reportCacheDegradation(SdkError $refused): void
    {
        $warning = 'the access token was obtained but not cached: ' . $refused->getMessage()
            . '. Every call will buy a fresh token until the cache works again';
        $this->logger?->warning($warning);
        @trigger_error($warning, E_USER_WARNING);
    }

    private function requestTokenWithCredentials(): TokenRecord
    {
        $response = $this->transport->sendHttpRequest(
            'POST',
            $this->tokenUrl(),
            jsonBody: $this->credentialsPayload(),
            headers: $this->tokenHeaders(),
            endpointTemplate: self::TOKEN_PATH_TEMPLATE,
        );
        if (!$response->succeeded()) {
            $messages = $response->getErrorMessages();
            throw new SdkAuthError(
                "the token request was answered {$response->statusCode}; the endpoint's own "
                . 'wording is on getErrorMessages() (' . count($messages) . ' reported)',
                statusCode: $response->statusCode,
                errorType: $response->errorType,
                // A token-endpoint body can carry a token even on a rejection.
                rawResponse: Redaction::redactValue($response->map),
                responseHeaders: Redaction::redactMapping($response->headers),
                requestInfo: $response->requestInfo,
                errors: $messages,
            );
        }
        // `map`, never `data`: `data` follows the caller's responseFormat.
        return $this->buildTokenRecord($response->map, $response);
    }

    private function requestTokenWithRefreshGrant(#[\SensitiveParameter] string $refreshToken): ?TokenRecord
    {
        $payload = [
            'grant_type' => self::REFRESH_GRANT_TYPE,
            'refresh_token' => $refreshToken,
        ] + $this->clientFields();
        try {
            $response = $this->transport->sendHttpRequest(
                'POST',
                $this->tokenUrl(),
                jsonBody: $payload,
                headers: $this->tokenHeaders(),
                endpointTemplate: self::TOKEN_PATH_TEMPLATE,
            );
        } catch (SdkError) {
            return null;
        }
        if (!$response->succeeded()) {
            return null;
        }
        try {
            return $this->buildTokenRecord($response->map, $response, $refreshToken);
        } catch (SdkAuthError) {
            return null;
        }
    }

    /** @return array<string,string> */
    private function credentialsPayload(): array
    {
        return [
            'grant_type' => $this->config->grantType(),
            'auth_string' => $this->config->authString(),
        ] + $this->clientFields();
    }

    /** @return array<string,string> */
    private function clientFields(): array
    {
        return [
            'redirect_uri' => $this->config->redirectUri(),
            'client_id' => $this->config->clientId(),
            'client_secret' => $this->config->clientSecret(),
        ];
    }

    /** @return array<string,string> */
    private function tokenHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => $this->config->userAgent,
        ];
    }

    private function buildTokenRecord(mixed $body, ApiResponse $response, ?string $previousRefreshToken = null): TokenRecord
    {
        $accessToken = is_array($body) ? ($body['access_token'] ?? null) : null;
        $accessToken = is_string($accessToken) ? TokenRecord::sendableTokenText($accessToken) : null;
        if (!is_array($body) || $accessToken === null) {
            throw new SdkAuthError(
                'token response has no usable access_token',
                statusCode: $response->statusCode,
                rawResponse: Redaction::redactValue($body),
                requestInfo: $response->requestInfo,
            );
        }
        $expiresIn = $body['expires_in'] ?? null;
        $ttl = is_numeric($expiresIn) ? (float) $expiresIn : (float) TokenRecord::DEFAULT_TTL_SECONDS;
        if (!is_finite($ttl) || $ttl <= 0) {
            $ttl = (float) TokenRecord::DEFAULT_TTL_SECONDS;
        }
        $ttl = min($ttl, (float) TokenRecord::MAX_TTL_SECONDS);
        $offeredRefresh = $body['refresh_token'] ?? null;
        if ($offeredRefresh !== null && !is_string($offeredRefresh)) {
            throw new SdkAuthError(
                'token response carried a refresh_token that is not a string',
                statusCode: $response->statusCode,
                rawResponse: Redaction::redactValue($body),
                requestInfo: $response->requestInfo,
            );
        }
        if (is_string($offeredRefresh) && trim($offeredRefresh) !== ''
            && TokenRecord::refreshTokenText($offeredRefresh) === null) {
            throw new SdkAuthError(
                'token response refresh_token is not visible ASCII',
                statusCode: $response->statusCode,
                rawResponse: Redaction::redactValue($body),
                requestInfo: $response->requestInfo,
            );
        }
        $offeredRefresh = is_string($offeredRefresh) ? TokenRecord::refreshTokenText($offeredRefresh) : null;
        $refresh = $offeredRefresh ?? $previousRefreshToken;
        // Skew never exceeds half the lifetime, so a short-lived token is not born expired.
        return new TokenRecord(
            $accessToken,
            $refresh,
            microtime(true) + $ttl,
            min((float) TokenRecord::SKEW_SECONDS, $ttl / 2),
        );
    }
}
