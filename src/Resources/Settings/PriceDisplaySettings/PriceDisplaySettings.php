<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto\PriceDisplaySettings as PriceDisplaySettingsBody;

/** Price display settings endpoints, under `/api/{api_version}/admin/settings/price_display_settings`:
 *  a facade over two sections, with no `PUT`. */
final class PriceDisplaySettings
{
    /** Retrieve the area - `GET /admin/settings/price_display_settings`, both sections and `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getPriceDisplaySettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PriceDisplaySettingsUrls::PRICE_DISPLAY_SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PriceDisplaySettingsBody::class);
    }

    /** Update the area - `PATCH /admin/settings/price_display_settings`, wrapped in
     *  `price_display_settings` and nothing else; partial at every level.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchPriceDisplaySettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(PriceDisplaySettingsUrls::PRICE_DISPLAY_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PriceDisplaySettingsBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/price_display_settings`; `200` with no body
     *  and an `ETag`. */
    public static function headPriceDisplaySettings(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PriceDisplaySettingsUrls::PRICE_DISPLAY_SETTINGS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/price_display_settings/{section}`, under the
     *  section's own key; `$section` is one of `PriceDisplaySettingsUrls::PRICE_DISPLAY_SETTINGS_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getPriceDisplaySettingsSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PriceDisplaySettingsUrls::PRICE_DISPLAY_SETTINGS_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PriceDisplaySettingsBody::class);
    }

    /** Update one section - `PATCH /admin/settings/price_display_settings/{section}`, wrapped in its own
     *  key or bare; while a block's `customize` is off, its `scopes` follow its `enabled`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchPriceDisplaySettingsSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(PriceDisplaySettingsUrls::PRICE_DISPLAY_SETTINGS_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PriceDisplaySettingsBody::class);
    }
}
