<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\OrderPreviews\OrderPreviewsDto\OrderPreview;
use WebCommander\Resources\Orders\OrdersDto\FlatOrder;

/** Order preview endpoints, under `/api/{api_version}/admin`. */
final class OrderPreviews
{
    /** Start an order preview - `POST /admin/orders/preview`, `201`, a priced session that places no order. `products` is required; read `order.session.session_id`, which every other call takes as `$previewSessionId`. The session lasts 30 minutes.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderPreview(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrderPreviewsUrls::ORDER_PREVIEWS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderPreview::class);
    }

    /** Read an order preview - `GET /admin/orders/preview/{preview_session_id}`, where the slot takes the `session_id` the start answered. A read does not extend the session. An unknown id is `404`, and a session already confirmed is `410` `session_confirmed`. */
    public static function getOrderPreview(WebCommanderClient $client, string $previewSessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrderPreviewsUrls::ORDER_PREVIEW, pathParams: ['preview_session_id' => $previewSessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderPreview::class);
    }

    /** Place the order - `POST /admin/orders/preview/{preview_session_id}/confirm`; `201` with the created order, and the body optional. This creates a real order and closes the session, so a second confirm, or any other call on it, is `410` `session_confirmed`. Without a `payment` the order is unpaid, and so it is after a `payment_gateway` alone.
     *  @param array<string,mixed>|string|Dto|null $payload */
    public static function confirmOrderPreview(WebCommanderClient $client, string $previewSessionId, array|string|Dto|null $payload = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrderPreviewsUrls::ORDER_PREVIEW_CONFIRM, pathParams: ['preview_session_id' => $previewSessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: FlatOrder::class);
    }

    /** Apply a coupon - `POST /admin/orders/preview/{preview_session_id}/coupon`, `200` with `session`, `discounts` and `totals`. One coupon at a time: a second is `409`, and a code the store does not accept is `422` `invalid_coupon`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function applyOrderPreviewCoupon(WebCommanderClient $client, string $previewSessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrderPreviewsUrls::ORDER_PREVIEW_COUPON, pathParams: ['preview_session_id' => $previewSessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderPreview::class);
    }

    /** Remove the coupon - `DELETE /admin/orders/preview/{preview_session_id}/coupon`, `204` with no body. With none applied it is `404` `coupon_not_applied`. */
    public static function removeOrderPreviewCoupon(WebCommanderClient $client, string $previewSessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(OrderPreviewsUrls::ORDER_PREVIEW_COUPON, pathParams: ['preview_session_id' => $previewSessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Apply a gift card - `POST /admin/orders/preview/{preview_session_id}/gift-card`, `200` with `session`, `discounts` and `totals`. The card must be the previewed customer's, active, paid, in date and with a balance, else `422` `invalid_gift_card`; a second card is `409`. It lowers `due` and spends nothing until an order is placed with it applied.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function applyOrderPreviewGiftCard(WebCommanderClient $client, string $previewSessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrderPreviewsUrls::ORDER_PREVIEW_GIFT_CARD, pathParams: ['preview_session_id' => $previewSessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderPreview::class);
    }

    /** Remove the gift card - `DELETE /admin/orders/preview/{preview_session_id}/gift-card`, `204` with no body. With none applied it is `404` `gift_card_not_applied`. */
    public static function removeOrderPreviewGiftCard(WebCommanderClient $client, string $previewSessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(OrderPreviewsUrls::ORDER_PREVIEW_GIFT_CARD, pathParams: ['preview_session_id' => $previewSessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
