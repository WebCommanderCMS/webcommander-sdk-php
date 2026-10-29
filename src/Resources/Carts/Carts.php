<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Carts\CartsDto\Cart;
use WebCommander\Resources\Carts\CartsDto\CartOrder;
use WebCommander\Resources\Carts\CartsDto\CartSession;

/** Cart endpoints, under `/api/{api_version}/carts`, and the order write under `/admin`. */
final class Carts
{
    /** Add a product to the cart `session_id` names, creating it - `POST /carts`, `201`; re-adding
     *  raises the line's quantity. `customer_id` is the customer's `internal_id`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function addCartItem(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(CartsUrls::CARTS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Cart::class);
    }

    /** Retrieve the cart - `GET /carts/{session_id}`, with `group_meta` beside it. A cart with no
     *  line is `400` `Your shopping cart is empty`. */
    public static function getCart(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CartsUrls::CART, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Cart::class);
    }

    /** Ask which session id to use - `PUT /carts/{session_id}`; nothing is stored. Answers the body's
     *  `sessionId`, the HTTP session's id when that is empty or null, else the path's.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function resolveCartSession(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(CartsUrls::CART, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CartSession::class);
    }

    /** Change one line's quantity - `PATCH /carts/{session_id}`. `cart_item_id` and `quantity` are
     *  required; the addresses are optional.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateCartItem(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CartsUrls::CART, pathParams: ['session_id' => $sessionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Cart::class);
    }

    /** Empty the cart - `DELETE /carts/{session_id}`; `204`, after which a read is `400`. */
    public static function deleteCart(WebCommanderClient $client, string $sessionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(CartsUrls::CART, pathParams: ['session_id' => $sessionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Remove one line - `DELETE /carts/{session_id}/cart_items/{cart_item_id}`; `204`.
     *  `cart_item_id` is a line's `id`; removing the last line empties the cart. */
    public static function deleteCartItem(WebCommanderClient $client, string $sessionId, int|string $cartItemId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(CartsUrls::CART_ITEM, pathParams: ['session_id' => $sessionId, 'cart_item_id' => $cartItemId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Turn the cart into an order - `POST /admin/orders/carts/{session_id}`, `201`, and the cart is
     *  gone. `customer_id` is the customer's `customer_id`, not its `internal_id`. `$transactionNo` is
     *  sent as `X-Transaction-No` and files the order under that number.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderFromCart(WebCommanderClient $client, string $sessionId, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(CartsUrls::CART_ORDER, pathParams: ['session_id' => $sessionId], jsonBody: $payload, headers: $transactionNo === null ? null : [CartsUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CartOrder::class);
    }
}
