<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of an order's refunds, newest first; `order_no` equals `order_id`. */
final class OrderRefundPage extends Dto
{
    /** @param list<OrderRefundRecord|null>|null $refunds */
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?int $internalId = null,
        public readonly ?int $orderNo = null,
        #[ListOf(OrderRefundRecord::class)]
        public readonly ?array $refunds = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
