<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** An order's shipments, unpaged. */
final class OrderShipmentList extends Dto
{
    /** @param list<OrderShipment|null>|null $shipments */
    public function __construct(
        #[ListOf(OrderShipment::class)]
        public readonly ?array $shipments = null,
    ) {
    }
}
