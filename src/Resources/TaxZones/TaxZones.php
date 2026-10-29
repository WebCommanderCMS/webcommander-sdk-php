<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxZones;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxZones\TaxZonesDto\TaxZone;
use WebCommander\Resources\TaxZones\TaxZonesDto\TaxZonePage;

/** Tax zone endpoints, under `/api/{api_version}/admin/tax_zones`. Most rows are
 *  `system_generated`, the store's own: do not write or delete one. */
final class TaxZones
{
    /** List the zones - `GET /admin/tax_zones`; `limit` is capped at 20, so page on `pagination.total`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTaxZones(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxZonesUrls::TAX_ZONES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxZonePage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/tax_zones`; `200` with no body. */
    public static function headTaxZones(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxZonesUrls::TAX_ZONES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a zone - `POST /admin/tax_zones`, `201`, wrapped in `tax_zone`. `countries` and `states`
     *  take `{"id": n}` records; `radius` and `start_location` are read only with `use_radius: true`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createTaxZone(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TaxZonesUrls::TAX_ZONES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxZone::class);
    }

    /** Retrieve one zone - `GET /admin/tax_zones/{tax_zone_id}`, the row under `tax_zone`; an unknown
     *  id is `404`. */
    public static function getTaxZone(WebCommanderClient $client, int|string $taxZoneId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxZonesUrls::TAX_ZONE, pathParams: ['tax_zone_id' => $taxZoneId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxZone::class);
    }

    /** Ask whether a zone's path answers - `HEAD /admin/tax_zones/{tax_zone_id}`. */
    public static function headTaxZone(WebCommanderClient $client, int|string $taxZoneId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxZonesUrls::TAX_ZONE, pathParams: ['tax_zone_id' => $taxZoneId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one zone - `PUT /admin/tax_zones/{tax_zone_id}`, wrapped, `name` required. Lists left
     *  out come back empty and `use_radius` false, so send every list that is to live.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateTaxZone(WebCommanderClient $client, int|string $taxZoneId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxZonesUrls::TAX_ZONE, pathParams: ['tax_zone_id' => $taxZoneId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxZone::class);
    }

    /** Delete one zone - `DELETE /admin/tax_zones/{tax_zone_id}`, `204` and hard. */
    public static function deleteTaxZone(WebCommanderClient $client, int|string $taxZoneId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(TaxZonesUrls::TAX_ZONE, pathParams: ['tax_zone_id' => $taxZoneId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
