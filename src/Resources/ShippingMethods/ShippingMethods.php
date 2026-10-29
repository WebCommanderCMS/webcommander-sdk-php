<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingMethods;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\ShippingMethods\ShippingMethodsDto\ShippingMethod;
use WebCommander\Resources\ShippingMethods\ShippingMethodsDto\ShippingMethodCount;
use WebCommander\Resources\ShippingMethods\ShippingMethodsDto\ShippingMethodPage;

/** Shipping method endpoints, under `/api/{api_version}/admin` and not `/admin/settings/`; nothing
 *  here reads or writes `shippingSettings`. */
final class ShippingMethods
{
    /** List the methods - `GET /admin/shipping_methods`, by ascending `id`. Takes `limit` (capped at
     *  20), `offset`, `page` and `field_metadata`; any other name is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listShippingMethods(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingMethodsUrls::SHIPPING_METHODS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingMethodPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/shipping_methods`; `200` with no body. */
    public static function headShippingMethods(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingMethodsUrls::SHIPPING_METHODS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many methods the store holds - `GET /admin/shipping_methods/count`, answering
     *  `{"shipping_methods": {"count": N}}`; no query parameter narrows it.
     *  @param array<string,mixed>|null $queryParams */
    public static function countShippingMethods(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingMethodsUrls::SHIPPING_METHODS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingMethodCount::class);
    }

    /** Create a method - `POST /admin/shipping_methods`, `201`; the `shipping_method` wrapper is
     *  required, a taken `name` is `409`, and `id` and `is_default` are discarded.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createShippingMethod(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ShippingMethodsUrls::SHIPPING_METHODS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingMethod::class);
    }

    /** Retrieve one method - `GET /admin/shipping_methods/{shipping_method_id}`, the row under
     *  `shipping_method`; `field_metadata=true` adds the schema beside it. An unknown id is `404`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getShippingMethod(WebCommanderClient $client, int|string $shippingMethodId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingMethodsUrls::SHIPPING_METHOD, pathParams: ['shipping_method_id' => $shippingMethodId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingMethod::class);
    }

    /** Ask whether a method's path answers - `HEAD /admin/shipping_methods/{shipping_method_id}`. */
    public static function headShippingMethod(WebCommanderClient $client, int|string $shippingMethodId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingMethodsUrls::SHIPPING_METHOD, pathParams: ['shipping_method_id' => $shippingMethodId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Update one method - `PUT /admin/shipping_methods/{shipping_method_id}`; the wrapper and `name`
     *  are required, and `name` is the only field read. `PATCH` has no handler.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateShippingMethod(WebCommanderClient $client, int|string $shippingMethodId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ShippingMethodsUrls::SHIPPING_METHOD, pathParams: ['shipping_method_id' => $shippingMethodId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingMethod::class);
    }

    /** Delete one method - `DELETE /admin/shipping_methods/{shipping_method_id}`, `204` and hard. The
     *  row holding `is_default` is `409 conflict` until the flag moves to another. */
    public static function deleteShippingMethod(WebCommanderClient $client, int|string $shippingMethodId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ShippingMethodsUrls::SHIPPING_METHOD, pathParams: ['shipping_method_id' => $shippingMethodId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Make one method the default - `PUT /admin/shipping_methods/{shipping_method_id}/default`, no
     *  body read. The flag is exclusive: the row that held it loses it. */
    public static function setShippingMethodDefault(WebCommanderClient $client, int|string $shippingMethodId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ShippingMethodsUrls::SHIPPING_METHOD_DEFAULT, pathParams: ['shipping_method_id' => $shippingMethodId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingMethod::class);
    }
}
