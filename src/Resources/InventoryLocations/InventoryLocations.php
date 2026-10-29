<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\InventoryLocations\InventoryLocationsDto\InventoryLocation;
use WebCommander\Resources\InventoryLocations\InventoryLocationsDto\InventoryLocationPage;
use WebCommander\Resources\InventoryLocations\InventoryLocationsDto\InventoryLocationStock;

/** Inventory location endpoints, under `/api/{api_version}/admin` and not `/admin/settings/`;
 *  `ecommerceSettings` previews these rows but nothing there writes one. */
final class InventoryLocations
{
    /** List the locations - `GET /admin/inventory_locations`, the default row first. Accepts `q`,
     *  `limit` (1 to 100, default 20) and `offset`; any other name, `page` included, is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listInventoryLocations(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(InventoryLocationsUrls::INVENTORY_LOCATIONS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocationPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/inventory_locations`; `200` with no body. */
    public static function headInventoryLocations(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', InventoryLocationsUrls::INVENTORY_LOCATIONS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a location - `POST /admin/inventory_locations`, `201`. The body is a bare record, not
     *  wrapped; `default: true` takes the flag off the row that held it.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createInventoryLocation(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(InventoryLocationsUrls::INVENTORY_LOCATIONS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocation::class);
    }

    /** Retrieve one location - `GET /admin/inventory_locations/{inventory_location_id}`, the row
     *  under `inventory_location`; an unknown id is `404`. */
    public static function getInventoryLocation(WebCommanderClient $client, int|string $inventoryLocationId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(InventoryLocationsUrls::INVENTORY_LOCATION, pathParams: ['inventory_location_id' => $inventoryLocationId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocation::class);
    }

    /** Ask whether a location's path answers - `HEAD /admin/inventory_locations/{inventory_location_id}`. */
    public static function headInventoryLocation(WebCommanderClient $client, int|string $inventoryLocationId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', InventoryLocationsUrls::INVENTORY_LOCATION, pathParams: ['inventory_location_id' => $inventoryLocationId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one location - `PUT /admin/inventory_locations/{inventory_location_id}`, bare record,
     *  not a merge: an omitted `address` is cleared and an omitted `active` reads true.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateInventoryLocation(WebCommanderClient $client, int|string $inventoryLocationId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(InventoryLocationsUrls::INVENTORY_LOCATION, pathParams: ['inventory_location_id' => $inventoryLocationId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocation::class);
    }

    /** Merge fields into one location - `PATCH /admin/inventory_locations/{inventory_location_id}`,
     *  a bare record of at least one field; what it omits keeps its stored value.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchInventoryLocation(WebCommanderClient $client, int|string $inventoryLocationId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(InventoryLocationsUrls::INVENTORY_LOCATION, pathParams: ['inventory_location_id' => $inventoryLocationId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocation::class);
    }

    /** Delete one location - `DELETE /admin/inventory_locations/{inventory_location_id}`, `204` and
     *  hard. The row holding `default` is `409 conflict` until the flag moves to another. */
    public static function deleteInventoryLocation(WebCommanderClient $client, int|string $inventoryLocationId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(InventoryLocationsUrls::INVENTORY_LOCATION, pathParams: ['inventory_location_id' => $inventoryLocationId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Read one location's stock - `GET /admin/inventory_locations/{inventory_location_id}/stock`,
     *  read-only, paged by `limit` and `offset` as the listing is.
     *  @param array<string,mixed>|null $queryParams */
    public static function getInventoryLocationStock(WebCommanderClient $client, int|string $inventoryLocationId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(InventoryLocationsUrls::INVENTORY_LOCATION_STOCK, pathParams: ['inventory_location_id' => $inventoryLocationId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocationStock::class);
    }

    /** Make one location the default - `PUT /admin/inventory_locations/{inventory_location_id}/default`,
     *  no body read. The flag is exclusive, and the row is made active too. */
    public static function setInventoryLocationDefault(WebCommanderClient $client, int|string $inventoryLocationId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(InventoryLocationsUrls::INVENTORY_LOCATION_DEFAULT, pathParams: ['inventory_location_id' => $inventoryLocationId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocation::class);
    }

    /** Set one location's `active` - `PUT /admin/inventory_locations/{inventory_location_id}/status`,
     *  a bare `{"active": ...}`; any other field is `400`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateInventoryLocationStatus(WebCommanderClient $client, int|string $inventoryLocationId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(InventoryLocationsUrls::INVENTORY_LOCATION_STATUS, pathParams: ['inventory_location_id' => $inventoryLocationId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InventoryLocation::class);
    }
}
