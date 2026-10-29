<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One line to ship, by the order line's `item_id`. */
final class ShipmentItemInput extends Dto
{
    public function __construct(
        public readonly ?int $orderItemId = null,
        public readonly ?int $quantity = null,
    ) {
    }
}
