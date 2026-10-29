<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ShippingSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\ShippingSettings\ShippingSettingsDto\ShippingSettings as ShippingSettingsBody;

/** Shipping settings endpoints - `/api/{api_version}/admin/settings/shipping_settings`, a flat area
 *  whose seven keys are fields, not sections. */
final class ShippingSettings
{
    /** Retrieve the settings - `GET /admin/settings/shipping_settings`, seven flat fields and a
     *  `group_meta` entry for the area itself.
     *  @param array<string,mixed>|null $queryParams */
    public static function getShippingSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingSettingsUrls::SHIPPING_SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingSettingsBody::class);
    }

    /** Update the settings - `PATCH /admin/settings/shipping_settings`, wrapped or bare; partial. Turning
     *  `enable_shipping_class` off also clears `enable_flat_view_class`, so write the two together.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchShippingSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ShippingSettingsUrls::SHIPPING_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingSettingsBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/shipping_settings`; `200` with no body. */
    public static function headShippingSettings(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingSettingsUrls::SHIPPING_SETTINGS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
