<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One line an order refund names, by the order line's `item_id`. */
final class RefundLineInput extends Dto
{
    public function __construct(
        public readonly ?int $orderItemId = null,
        public readonly ?int $quantity = null,
        public readonly ?float $amount = null,
    ) {
    }
}
