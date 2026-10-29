<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto\EcommerceSettings as EcommerceSettingsBody;

/** Ecommerce settings endpoints, under `/api/{api_version}/admin/settings/ecommerce_settings`: a
 *  facade over six sections, plus the inlined `order_flags` rows, which are no section. */
final class EcommerceSettings
{
    /** Retrieve the area - `GET /admin/settings/ecommerce_settings`, the six sections, `order_flags` and
     *  `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getEcommerceSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(EcommerceSettingsUrls::ECOMMERCE_SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: EcommerceSettingsBody::class);
    }

    /** Update the area - `PATCH /admin/settings/ecommerce_settings`, wrapped in `ecommerce_settings`
     *  and nothing else; partial. There is no `PUT`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchEcommerceSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(EcommerceSettingsUrls::ECOMMERCE_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: EcommerceSettingsBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/ecommerce_settings`; `200` with no body and
     *  the `ETag` a `GET` carries. */
    public static function headEcommerceSettings(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', EcommerceSettingsUrls::ECOMMERCE_SETTINGS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/ecommerce_settings/{section}`, under the section's
     *  own key; `$section` is one of `EcommerceSettingsUrls::ECOMMERCE_SETTINGS_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getEcommerceSettingsSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(EcommerceSettingsUrls::ECOMMERCE_SETTINGS_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: EcommerceSettingsBody::class);
    }

    /** Update one section - `PATCH /admin/settings/ecommerce_settings/{section}`, wrapped in its own
     *  key or bare; an unknown field is `400` even beside a known one.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchEcommerceSettingsSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(EcommerceSettingsUrls::ECOMMERCE_SETTINGS_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: EcommerceSettingsBody::class);
    }
}
