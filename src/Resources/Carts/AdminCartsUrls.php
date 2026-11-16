<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts;

final class AdminCartsUrls
{
    public const ADMIN_CARTS = '/api/{api_version}/admin/orders/carts';
    public const ADMIN_CART = '/api/{api_version}/admin/orders/carts/{session_id}';
    public const ADMIN_CART_ITEMS = '/api/{api_version}/admin/orders/carts/{session_id}/cart_items';
    public const ADMIN_CART_ITEM = '/api/{api_version}/admin/orders/carts/{session_id}/cart_items/{cart_item_id}';
    public const ADMIN_CHECKOUT = '/api/{api_version}/admin/orders/checkout/{session_id}';
    public const ADMIN_CHECKOUT_CONFIRM = '/api/{api_version}/admin/orders/checkout/{session_id}/confirm';
    public const ADMIN_CHECKOUT_COUPON = '/api/{api_version}/admin/orders/checkout/{session_id}/coupon';
    public const ADMIN_CHECKOUT_GIFT_CARD = '/api/{api_version}/admin/orders/checkout/{session_id}/gift_card';
    public const ADMIN_CHECKOUT_DELIVERY_SCHEDULES = '/api/{api_version}/admin/orders/checkout/{session_id}/delivery_schedules';

    /** Files the order a checkout places under this transaction number; a differing top-level `transaction_no` is `400 header_body_mismatch`. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
