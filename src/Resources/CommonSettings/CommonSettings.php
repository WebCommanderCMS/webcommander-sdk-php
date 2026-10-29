<?php

declare(strict_types=1);

namespace WebCommander\Resources\CommonSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\CommonSettings\CommonSettingsDto\CommonSettings as CommonSettingsBody;
use WebCommander\Resources\CommonSettings\CommonSettingsDto\CustomerFields;

/** Common settings endpoints, under `/api/{api_version}`. */
final class CommonSettings
{
    /** Read the store's settings - `GET /settings`, `{"settings": {group: [{"config_key", "value"}]}}`.
     *  `type` names one group, an unknown one `404`; `config_key` one key, with or without `type`. A
     *  comma list of keys matches nothing and answers `{"settings": {}}`. Secrets read `***`. Other
     *  names, paging included, are `400`. Without `type` the answer is every group, about 2 MB, and
     *  can take 30 seconds or more.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CommonSettingsUrls::SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CommonSettingsBody::class);
    }

    /** Ask whether the settings are reachable - `HEAD /settings`; no body. It runs the read's query,
     *  so pass a `type`: an unknown one is `404`.
     *  @param array<string,mixed>|null $queryParams */
    public static function headSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CommonSettingsUrls::SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Save settings - `PUT /settings` with `{"settings": {group: ...}}`; `200` and every group of the
     *  store. Only the keys sent change, and one bad entry refuses the whole request with `400`. A
     *  write was measured at 5 to 53 seconds, past the default 30 of `timeoutSeconds` at the slow
     *  end: build the client with a longer one.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(CommonSettingsUrls::SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CommonSettingsBody::class);
    }

    /** Save settings - `POST /settings`, the `PUT`'s body, behaviour and timing, answered `201`. A
     *  `POST` is not resent after a timeout, so read the keys back before retrying.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function saveSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(CommonSettingsUrls::SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CommonSettingsBody::class);
    }

    /** Read the customer registration form - `GET /create-customer-fields`, the active `fields` in
     *  order and every field's `fields_configs`. Any query name is `400`. */
    public static function getCreateCustomerFields(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CommonSettingsUrls::CREATE_CUSTOMER_FIELDS, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerFields::class);
    }

    /** Ask whether the registration form is there - `HEAD /create-customer-fields`; no body. */
    public static function headCreateCustomerFields(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CommonSettingsUrls::CREATE_CUSTOMER_FIELDS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
