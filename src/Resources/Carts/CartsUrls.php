<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts;

final class CartsUrls
{
    public const CARTS = '/api/{api_version}/carts';
    public const CART = '/api/{api_version}/carts/{session_id}';
    public const CART_ITEM = '/api/{api_version}/carts/{session_id}/cart_items/{cart_item_id}';

    /** The one cart path under `/admin`. */
    public const CART_ORDER = '/api/{api_version}/admin/orders/carts/{session_id}';

    /** Files the order a cart becomes under this transaction number; it beats `transaction_no`. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
