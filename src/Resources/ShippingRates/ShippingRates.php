<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\ShippingRates\ShippingRatesDto\ShippingRate;
use WebCommander\Resources\ShippingRates\ShippingRatesDto\ShippingRateCount;
use WebCommander\Resources\ShippingRates\ShippingRatesDto\ShippingRateListing;

/** Shipping rate endpoints, under `/api/{api_version}/admin`. */
final class ShippingRates
{
    /** List the rates, newest first - `GET /admin/shipping_rates`. `search` (part of the name), `method` (such as `flat_rate` or `ship_by_weight`) and `handling_cost` (`with_handling` or `without_handling`) filter; `sort` is `id`, `name`, `method`, `created_at`, `updated_at` or `transaction_no` with `order` `asc` or `desc`; `limit` is 1 to 100 and defaults to 20, `offset` pages. An unknown value is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listShippingRates(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingRatesUrls::SHIPPING_RATES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRateListing::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/shipping_rates`; `200` with no body. */
    public static function headShippingRates(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingRatesUrls::SHIPPING_RATES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many rates match - `GET /admin/shipping_rates/count`, a bare `{"total": N}`. The listing's filters narrow it.
     *  @param array<string,mixed>|null $queryParams */
    public static function countShippingRates(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingRatesUrls::SHIPPING_RATES_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRateCount::class);
    }

    /** Ask whether the count answers - `HEAD /admin/shipping_rates/count`; `200` with no body. */
    public static function headShippingRatesCount(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingRatesUrls::SHIPPING_RATES_COUNT, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a rate - `POST /admin/shipping_rates` with `{"shipping_rate": {...}}`, `201` with a `Location`. `name` is required and unique without regard to case (`409`), and so is `method`. A flat rate needs `shipping_cost`; `ship_by_price`, `ship_by_quantity`, `ship_by_weight` and `ship_by_variation` take their costs per row in `conditions` and refuse a rate-level `shipping_cost`. `free_shipping` always saves `calculate_for_entire_order` false. `shipping_rule_id` attaches the rate to a rule that has none (`409` otherwise). An unknown field, an `id` or an unwrapped body is `400`. `$transactionNo` is sent as `X-Transaction-No`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createShippingRate(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ShippingRatesUrls::SHIPPING_RATES, jsonBody: $payload, headers: $transactionNo === null ? null : [ShippingRatesUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRate::class);
    }

    /** Retrieve one rate - `GET /admin/shipping_rates/{shipping_rate_id}`. An id that is not plain digits, or unknown, is `404`. */
    public static function getShippingRate(WebCommanderClient $client, int|string $shippingRateId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingRatesUrls::SHIPPING_RATE, pathParams: ['shipping_rate_id' => $shippingRateId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRate::class);
    }

    /** Ask whether a rate exists - `HEAD /admin/shipping_rates/{shipping_rate_id}`; `200` with no body, `404` for an unknown id. */
    public static function headShippingRate(WebCommanderClient $client, int|string $shippingRateId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingRatesUrls::SHIPPING_RATE, pathParams: ['shipping_rate_id' => $shippingRateId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one rate - `PUT /admin/shipping_rates/{shipping_rate_id}`. Every field is required: `name`, `method`, `calculate_for_entire_order`, `price_entered_with_tax`, the costs the method uses and `additional_rule`; a `handling_cost` or `additional_rule` the rate does not use is sent as null. A field left out is `400` naming it.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateShippingRate(WebCommanderClient $client, int|string $shippingRateId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ShippingRatesUrls::SHIPPING_RATE, pathParams: ['shipping_rate_id' => $shippingRateId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRate::class);
    }

    /** Change only the fields sent - `PATCH /admin/shipping_rates/{shipping_rate_id}`; the costs, rows and boxes not sent are kept. An empty `shipping_rate` changes nothing and is `200`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchShippingRate(WebCommanderClient $client, int|string $shippingRateId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ShippingRatesUrls::SHIPPING_RATE, pathParams: ['shipping_rate_id' => $shippingRateId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRate::class);
    }

    /** Delete one rate - `DELETE /admin/shipping_rates/{shipping_rate_id}`, `204`. A rate a rule uses is `409` until the rule lets it go. */
    public static function deleteShippingRate(WebCommanderClient $client, int|string $shippingRateId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ShippingRatesUrls::SHIPPING_RATE, pathParams: ['shipping_rate_id' => $shippingRateId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
