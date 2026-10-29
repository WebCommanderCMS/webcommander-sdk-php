<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderFlags;

final class OrderFlagsUrls
{
    public const ORDER_FLAGS = '/api/{api_version}/admin/order_flags';
    public const ORDER_FLAG = '/api/{api_version}/admin/order_flags/{order_flag_id}';
}
