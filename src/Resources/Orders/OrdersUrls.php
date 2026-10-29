<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders;

final class OrdersUrls
{
    public const ORDERS = '/api/{api_version}/admin/orders';
    public const ORDERS_COUNT = '/api/{api_version}/admin/orders/count';
    public const ORDERS_WITH_PAYMENT = '/api/{api_version}/admin/orders/with-payment';
    public const ORDER = '/api/{api_version}/admin/orders/{order_id}';
    public const ORDER_ADDRESSES = '/api/{api_version}/admin/orders/{order_id}/addresses';
    public const ORDER_CANCEL = '/api/{api_version}/admin/orders/{order_id}/cancel';
    public const ORDER_COMMENTS = '/api/{api_version}/admin/orders/{order_id}/comments';
    public const ORDER_PAYMENTS = '/api/{api_version}/admin/orders/{order_id}/payments';
    public const ORDER_REFUNDS = '/api/{api_version}/admin/orders/{order_id}/refunds';
    public const ORDER_SHIPMENT_STATUS = '/api/{api_version}/admin/orders/{order_id}/shipment-status';
    public const ORDER_SHIPMENTS = '/api/{api_version}/admin/orders/{order_id}/shipments';
    public const ORDER_SHIPMENT = '/api/{api_version}/admin/orders/{order_id}/shipments/{shipment_id}';
    public const ORDER_UPDATE_STATUS = '/api/{api_version}/admin/orders/{order_id}/update-status';

    public const ORDER_CUSTOM_FIELDS = '/api/{api_version}/admin/orders/{order_internal_id}/custom_fields';
    public const ORDER_SEND_INVOICE = '/api/{api_version}/admin/orders/{order_internal_id}/send-invoice';

    public const PAYMENT_REFUNDS = '/api/{api_version}/admin/payment/{payment_id}/refunds';
    public const ORDER_STATUS_ADD = '/api/{api_version}/admin/order/add-order-status';
    public const CUSTOMER_ORDERS = '/api/{api_version}/admin/customers/{customer_id}/orders';

    /** Sent by `createPaymentRefund()`. */
    public const IDEMPOTENCY_KEY_HEADER = 'Idempotency-Key';

    /** Files a created order under this transaction number; it beats a `transaction_no` body field. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
