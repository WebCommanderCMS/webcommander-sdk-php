<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxSettings\TaxSettingsDto\TaxSettings as TaxSettingsBody;

/** The tax settings facade - `/api/{api_version}/admin/tax/settings`, flat, with only `GET` and
 *  `PUT` served; there is no `HEAD`. */
final class TaxSettings
{
    /** Retrieve the settings - `GET /admin/tax/settings`, nine keys under `tax_settings`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getTaxSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxSettingsUrls::TAX_SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxSettingsBody::class);
    }

    /** Update the settings - `PUT /admin/tax/settings`, a merge wrapped in `settings`, not the
     *  `tax_settings` it answers under.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function putTaxSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxSettingsUrls::TAX_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxSettingsBody::class);
    }
}
