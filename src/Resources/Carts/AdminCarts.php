<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Carts\AdminCartsDto\AdminCart;
use WebCommander\Resources\Carts\AdminCartsDto\AdminCheckout;
use WebCommander\Resources\Orders\OrdersDto\FlatOrder;

/** Admin cart and checkout endpoints, under `/api/{api_version}/admin/orders`. */
final class AdminCarts
{
    /** Start a cart for a customer - `POST /admin/orders/carts`, `201`. `customer_id` is the customer's `customer_id` and `products` (`product_id` and `quantity`) is required. Keep `cart.session.session_id`: every other call takes it as `$sessionId`. The session lasts 30 minutes from the last write.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createAdminCart(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCartsUrls::ADMIN_CARTS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Read the cart - `GET /admin/orders/carts/{session_id}`, where the slot takes `cart.session.session_id`. A deleted cart is `410` `session_deleted` and one an order was placed from is `410` `session_confirmed`. */
    public static function getAdminCart(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCartsUrls::ADMIN_CART, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Replace the cart's customer and lines - `PUT /admin/orders/carts/{session_id}`, `200`. `customer_id` and `products` are both sent. The lines are put on again, so each gets a new `cart_item_id`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function replaceAdminCart(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(AdminCartsUrls::ADMIN_CART, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Change the cart's customer - `PATCH /admin/orders/carts/{session_id}`, `200`. Only `customer_id` is taken, and it is required: `products` is `400` `unknown_field`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateAdminCart(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(AdminCartsUrls::ADMIN_CART, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Delete the cart - `DELETE /admin/orders/carts/{session_id}`; `204` with no body, after which every call on the session is `410`. */
    public static function deleteAdminCart(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AdminCartsUrls::ADMIN_CART, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Put products on the cart - `POST /admin/orders/carts/{session_id}/cart_items`, `201` with the whole cart. `products` is required; one already on the cart raises that line's quantity.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function addAdminCartItems(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCartsUrls::ADMIN_CART_ITEMS, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Take every line off the cart - `DELETE /admin/orders/carts/{session_id}/cart_items`, `200` with the empty cart. The session stays. */
    public static function clearAdminCartItems(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AdminCartsUrls::ADMIN_CART_ITEMS, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Set one line's quantity - `PATCH /admin/orders/carts/{session_id}/cart_items/{cart_item_id}`, `200` with the cart. `cart_item_id` is a line's `cart_item_id` and `quantity` is required. A line the cart does not hold is `404`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateAdminCartItem(WebCommanderClient $client, string $sessionId, int|string $cartItemId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(AdminCartsUrls::ADMIN_CART_ITEM, pathParams: ['session_id' => $sessionId, 'cart_item_id' => $cartItemId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Take one line off the cart - `DELETE /admin/orders/carts/{session_id}/cart_items/{cart_item_id}`, `200` with the cart. `cart_item_id` is a line's `cart_item_id`; one the cart does not hold is `404`. */
    public static function deleteAdminCartItem(WebCommanderClient $client, string $sessionId, int|string $cartItemId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AdminCartsUrls::ADMIN_CART_ITEM, pathParams: ['session_id' => $sessionId, 'cart_item_id' => $cartItemId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCart::class);
    }

    /** Read the checkout of a cart - `GET /admin/orders/checkout/{session_id}`. `issues` lists what still blocks a confirm, `delivery_type` `required` until one is set; the addresses start as the customer's. */
    public static function getCheckout(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCartsUrls::ADMIN_CHECKOUT, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Set the delivery and addresses - `PATCH /admin/orders/checkout/{session_id}`, `200` with the priced checkout. Only `delivery_type`, `billing_address` and `shipping_address` are taken. The shipping and handling cost follow the shipping address, so set it with `delivery_type`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateCheckout(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(AdminCartsUrls::ADMIN_CHECKOUT, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Place the order - `POST /admin/orders/checkout/{session_id}/confirm`; `201` with the order, and the body optional. This creates a real order and closes the session, so every later call on it is `410` `session_confirmed`. A checkout with `issues` is `422` `checkout_incomplete`. Without a `payment` the order is unpaid. `$transactionNo` is sent as `X-Transaction-No` and files the order under that number; a different `transaction_no` in the body is `400` `header_body_mismatch`.
     *  @param array<string,mixed>|string|Dto|null $payload */
    public static function confirmCheckout(WebCommanderClient $client, string $sessionId, array|string|Dto|null $payload = null, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCartsUrls::ADMIN_CHECKOUT_CONFIRM, pathParams: ['session_id' => $sessionId], jsonBody: $payload, headers: $transactionNo === null ? null : [AdminCartsUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: FlatOrder::class);
    }

    /** Apply a coupon - `POST /admin/orders/checkout/{session_id}/coupon`, `200`. `code` is required. One coupon at a time: a second is `409`, and a code the store does not accept is `422` `invalid_coupon`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function applyCheckoutCoupon(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCartsUrls::ADMIN_CHECKOUT_COUPON, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Remove the coupon - `DELETE /admin/orders/checkout/{session_id}/coupon`. With none applied it is `404` `coupon_not_applied`. */
    public static function removeCheckoutCoupon(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AdminCartsUrls::ADMIN_CHECKOUT_COUPON, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Apply a gift card - `POST /admin/orders/checkout/{session_id}/gift_card`, `200`. `code` is required. The card must be usable by the cart's customer, else `422` `invalid_gift_card`; a second card is `409`. It lowers `due` and spends nothing until an order is placed.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function applyCheckoutGiftCard(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCartsUrls::ADMIN_CHECKOUT_GIFT_CARD, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Remove the gift card - `DELETE /admin/orders/checkout/{session_id}/gift_card`. With none applied it is `404` `gift_card_not_applied`. */
    public static function removeCheckoutGiftCard(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AdminCartsUrls::ADMIN_CHECKOUT_GIFT_CARD, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Read the chosen delivery schedule - `GET /admin/orders/checkout/{session_id}/delivery_schedules`, with `session` and `delivery_schedule`, which is null until one is set. */
    public static function getCheckoutDeliverySchedules(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCartsUrls::ADMIN_CHECKOUT_DELIVERY_SCHEDULES, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Choose a delivery schedule and date - `PUT /admin/orders/checkout/{session_id}/delivery_schedules`. `id` and `date` are both required. Only a `delivery_type` of `delivery` takes one (else `422`), an unknown `id` is `404` and one that does not apply to the order is `422` `schedule_not_applicable`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function setCheckoutDeliverySchedule(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(AdminCartsUrls::ADMIN_CHECKOUT_DELIVERY_SCHEDULES, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AdminCheckout::class);
    }

    /** Clear the delivery schedule - `DELETE /admin/orders/checkout/{session_id}/delivery_schedules`; `204` with no body, and also when none was set. */
    public static function clearCheckoutDeliverySchedule(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AdminCartsUrls::ADMIN_CHECKOUT_DELIVERY_SCHEDULES, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
