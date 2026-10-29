<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of an order's refunds, newest first. `order_id` is the order's internal id and
 *  `order_no` the `{order_id}` the path took. */
final class OrderRefundPage extends Dto
{
    /** @param list<OrderRefundRecord|null>|null $refunds */
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?int $orderNo = null,
        #[ListOf(OrderRefundRecord::class)]
        public readonly ?array $refunds = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
