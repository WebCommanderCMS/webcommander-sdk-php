<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderFlags;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\OrderFlags\OrderFlagsDto\OrderFlag;
use WebCommander\Resources\OrderFlags\OrderFlagsDto\OrderFlagPage;

/** Order flag endpoints, under `/api/{api_version}/admin` and not `/admin/settings/`;
 *  `ecommerceSettings` inlines these rows but nothing there writes one. */
final class OrderFlags
{
    /** List the flags - `GET /admin/order_flags`, ordered by `name`. Takes `limit` (capped at 20),
     *  `offset`, `page` and `field_metadata`; any other name is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listOrderFlags(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrderFlagsUrls::ORDER_FLAGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderFlagPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/order_flags`; `200` with no body and no `ETag`. */
    public static function headOrderFlags(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', OrderFlagsUrls::ORDER_FLAGS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a flag - `POST /admin/order_flags`, `201`, wrapped in `order_flag`; `name` and a hex
     *  `color` are required, a taken `name` is `409`, and `type` is discarded.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderFlag(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrderFlagsUrls::ORDER_FLAGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderFlag::class);
    }

    /** Retrieve one flag - `GET /admin/order_flags/{order_flag_id}`, the row under `order_flag`; an
     *  unknown id is `404`. */
    public static function getOrderFlag(WebCommanderClient $client, int|string $orderFlagId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrderFlagsUrls::ORDER_FLAG, pathParams: ['order_flag_id' => $orderFlagId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderFlag::class);
    }

    /** Ask whether a flag's path answers - `HEAD /admin/order_flags/{order_flag_id}`; `200` with no body. */
    public static function headOrderFlag(WebCommanderClient $client, int|string $orderFlagId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', OrderFlagsUrls::ORDER_FLAG, pathParams: ['order_flag_id' => $orderFlagId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one flag - `PUT /admin/order_flags/{order_flag_id}`, wrapped; `name` and `color` are
     *  required and an omitted `description` comes back null. `PATCH` is `405`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateOrderFlag(WebCommanderClient $client, int|string $orderFlagId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(OrderFlagsUrls::ORDER_FLAG, pathParams: ['order_flag_id' => $orderFlagId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderFlag::class);
    }

    /** Delete one flag - `DELETE /admin/order_flags/{order_flag_id}`, `204` and hard. */
    public static function deleteOrderFlag(WebCommanderClient $client, int|string $orderFlagId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(OrderFlagsUrls::ORDER_FLAG, pathParams: ['order_flag_id' => $orderFlagId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
