<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxSettings\TaxSettingsDto\TaxSettings as TaxSettingsBody;

/** The tax settings facade - `/api/{api_version}/admin/settings/tax`, flat, served on `GET`, `PUT`,
 *  `PATCH` and `HEAD`. */
final class TaxSettings
{
    /** Retrieve the settings - `GET /admin/settings/tax`, nine keys under `tax_settings`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getTaxSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxSettingsUrls::TAX_SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxSettingsBody::class);
    }

    /** Update the settings - `PUT /admin/settings/tax`, a merge wrapped in `tax_settings`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function putTaxSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxSettingsUrls::TAX_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxSettingsBody::class);
    }

    /** Update one field or several - `PATCH /admin/settings/tax`, wrapped in `tax_settings`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchTaxSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(TaxSettingsUrls::TAX_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxSettingsBody::class);
    }

    /** Ask whether the settings are reachable - `HEAD /admin/settings/tax`; no body. */
    public static function headTaxSettings(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxSettingsUrls::TAX_SETTINGS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
