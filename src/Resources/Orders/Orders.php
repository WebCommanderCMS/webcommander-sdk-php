<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Orders\OrdersDto\CustomerOrders;
use WebCommander\Resources\Orders\OrdersDto\FlatOrder;
use WebCommander\Resources\Orders\OrdersDto\InvoiceDispatch;
use WebCommander\Resources\Orders\OrdersDto\Order;
use WebCommander\Resources\Orders\OrdersDto\OrderAddresses;
use WebCommander\Resources\Orders\OrdersDto\OrderComment;
use WebCommander\Resources\Orders\OrdersDto\OrderCommentList;
use WebCommander\Resources\Orders\OrdersDto\OrderCount;
use WebCommander\Resources\Orders\OrdersDto\OrderCustomFields;
use WebCommander\Resources\Orders\OrdersDto\OrderPage;
use WebCommander\Resources\Orders\OrdersDto\OrderRefund;
use WebCommander\Resources\Orders\OrdersDto\OrderRefundPage;
use WebCommander\Resources\Orders\OrdersDto\OrderShipment;
use WebCommander\Resources\Orders\OrdersDto\OrderShipmentList;
use WebCommander\Resources\Orders\OrdersDto\PaymentReceipt;
use WebCommander\Resources\Orders\OrdersDto\PaymentRefund;
use WebCommander\Resources\Orders\OrdersDto\ShipmentStatus;

/** Order endpoints, under `/api/{api_version}/admin`. */
final class Orders
{
    /** List orders - `GET /admin/orders`, newest first; cancelled only under `order_status`.
     *  `limit` caps at 20, `customerId` takes an `internal_id`, an unknown name is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listOrders(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDERS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderPage::class);
    }

    /** Count orders - `GET /admin/orders/count`, `{"orders": {"count": N}}`. The listing's filters
     *  narrow it; its paging, sort and `field_metadata` change nothing.
     *  @param array<string,mixed>|null $queryParams */
    public static function countOrders(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDERS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderCount::class);
    }

    /** Create an order - `POST /admin/orders`, `201` with the flat order shape and `status`. Only
     *  `products` is required; `payment_gateway` takes a code such as `PIS`. `$transactionNo` is sent
     *  as `X-Transaction-No` and files the order under that number.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrder(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDERS, jsonBody: $payload, headers: $transactionNo === null ? null : [OrdersUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: FlatOrder::class);
    }

    /** Create an order and record a payment on it - `POST /admin/orders/with-payment`; `201`.
     *  `payment` is required and filed under gateway `API`; `transaction_no` is dropped.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderWithPayment(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDERS_WITH_PAYMENT, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: FlatOrder::class);
    }

    /** Retrieve one order - `GET /admin/orders/{order_id}`. `field_metadata` adds the listing's
     *  schema block; any other parameter is ignored.
     *  @param array<string,mixed>|null $queryParams */
    public static function getOrder(WebCommanderClient $client, int|string $orderId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDER, pathParams: ['order_id' => $orderId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Order::class);
    }

    /** Update an order - `PUT /admin/orders/{order_id}`: the customer and the addresses, each address
     *  sent replacing the stored one. Sections left out are kept; `items` is `400`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateOrder(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(OrdersUrls::ORDER, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Order::class);
    }

    /** Change named fields - `PATCH /admin/orders/{order_id}`: `order_status`, the addresses,
     *  `customer_po_number`, `payment_term`, `order_channel` and `ip_address`, flat or under
     *  `fulfillment`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchOrder(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(OrdersUrls::ORDER, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Order::class);
    }

    /** Delete an order - `DELETE /admin/orders/{order_id}`; hard. Read `status`: `deleted`, or
     *  `not_found` for an id no order holds, both at `200`. */
    public static function deleteOrder(WebCommanderClient $client, int|string $orderId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(OrdersUrls::ORDER, pathParams: ['order_id' => $orderId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one or both addresses - `PATCH /admin/orders/{order_id}/addresses`; an address left
     *  out is untouched, and `country_code` or a `country` object both resolve.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateOrderAddresses(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(OrdersUrls::ORDER_ADDRESSES, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderAddresses::class);
    }

    /** Cancel an order - `POST /admin/orders/{order_id}/cancel`; `201`, the body optional. An order
     *  already cancelled is `409`; `updateOrderStatus` can move it back.
     *  @param array<string,mixed>|string|Dto|null $payload */
    public static function cancelOrder(WebCommanderClient $client, int|string $orderId, array|string|Dto|null $payload = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDER_CANCEL, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: FlatOrder::class);
    }

    /** An order's comments, oldest first and unpaged - `GET /admin/orders/{order_id}/comments`. */
    public static function listOrderComments(WebCommanderClient $client, int|string $orderId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDER_COMMENTS, pathParams: ['order_id' => $orderId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderCommentList::class);
    }

    /** Add a comment - `POST /admin/orders/{order_id}/comments`; `201`. A bare record: a `comment`
     *  wrapper hides `content` and is `400`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderComment(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDER_COMMENTS, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderComment::class);
    }

    /** An order's custom field values - `GET /admin/orders/{order_internal_id}/custom_fields`. Pass
     *  `internal_id`: an `order_id` there reads the order whose `internal_id` it is. */
    public static function getOrderCustomFields(WebCommanderClient $client, int|string $orderInternalId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDER_CUSTOM_FIELDS, pathParams: ['order_internal_id' => $orderInternalId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderCustomFields::class);
    }

    /** Record a payment - `POST /admin/orders/{order_id}/payments`; `201`. The `payment` wrapper is
     *  required, and the receipt's `id` is what a payment refund takes.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderPayment(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDER_PAYMENTS, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PaymentReceipt::class);
    }

    /** List an order's refunds, newest first - `GET /admin/orders/{order_id}/refunds`, by the order's
     *  `order_id`. `limit` is 1 to 20 (above 20 is capped, `0` is `400`), with `offset` or a 1-based
     *  `page`; any other name is ignored.
     *  @param array<string,mixed>|null $queryParams */
    public static function listOrderRefunds(WebCommanderClient $client, int|string $orderId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDER_REFUNDS, pathParams: ['order_id' => $orderId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderRefundPage::class);
    }

    /** Refund against an order - `POST /admin/orders/{order_id}/refunds`; `201`. It raises
     *  `refunded`, leaves `paid` alone, and cannot pass what was paid less earlier refunds.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderRefund(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDER_REFUNDS, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderRefund::class);
    }

    /** Refund part of a payment - `POST /admin/payment/{payment_id}/refunds`; `200`. Refused without
     *  `$idempotencyKey`; a repeat under the same key replays the first refund.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createPaymentRefund(WebCommanderClient $client, int|string $paymentId, array|string|Dto $payload, string $idempotencyKey, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::PAYMENT_REFUNDS, pathParams: ['payment_id' => $paymentId], jsonBody: $payload, headers: [OrdersUrls::IDEMPOTENCY_KEY_HEADER => $idempotencyKey], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PaymentRefund::class);
    }

    /** Email the invoice - `POST /admin/orders/{order_internal_id}/send-invoice`; no body. Pass
     *  `internal_id`: an `order_id` there names the order holding it as its `internal_id`. */
    public static function sendOrderInvoice(WebCommanderClient $client, int|string $orderInternalId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDER_SEND_INVOICE, pathParams: ['order_internal_id' => $orderInternalId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: InvoiceDispatch::class);
    }

    /** How far an order has shipped - `GET /admin/orders/{order_id}/shipment-status`. */
    public static function getOrderShipmentStatus(WebCommanderClient $client, int|string $orderId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDER_SHIPMENT_STATUS, pathParams: ['order_id' => $orderId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShipmentStatus::class);
    }

    /** List an order's shipments - `GET /admin/orders/{order_id}/shipments`; unpaged. */
    public static function listOrderShipments(WebCommanderClient $client, int|string $orderId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::ORDER_SHIPMENTS, pathParams: ['order_id' => $orderId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderShipmentList::class);
    }

    /** Ship order lines - `POST /admin/orders/{order_id}/shipments`; `201`. `method`,
     *  `shipping_date` and `shipment_items` are required; `tracking_info` may be left out.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderShipment(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDER_SHIPMENTS, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderShipment::class);
    }

    /** Change a shipment - `PATCH /admin/orders/{order_id}/shipments/{shipment_id}`, by its
     *  `shipping_id`; a field left out is kept, and `shipment_items` needs `change_note`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateOrderShipment(WebCommanderClient $client, int|string $orderId, int|string $shipmentId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(OrdersUrls::ORDER_SHIPMENT, pathParams: ['order_id' => $orderId, 'shipment_id' => $shipmentId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderShipment::class);
    }

    /** Move an order's status - `PATCH /admin/orders/{order_id}/update-status`; answered with the
     *  flat order shape. A completed or cancelled order can be moved again.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateOrderStatus(WebCommanderClient $client, int|string $orderId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(OrdersUrls::ORDER_UPDATE_STATUS, pathParams: ['order_id' => $orderId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: FlatOrder::class);
    }

    /** Add a custom order status - `POST /admin/order/add-order-status`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createOrderStatus(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrdersUrls::ORDER_STATUS_ADD, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** One customer's orders - `GET /admin/customers/{customer_id}/orders`, by the public
     *  `customer_id`; unpaged, no parameter read, and cancelled orders left out. */
    public static function listCustomerOrders(WebCommanderClient $client, int|string $customerId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrdersUrls::CUSTOMER_ORDERS, pathParams: ['customer_id' => $customerId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerOrders::class);
    }
}
