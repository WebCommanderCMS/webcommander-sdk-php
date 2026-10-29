<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The shipment status: `unshipped`, `partial` or `shipped`, where the order itself reads
 *  `not_shipped` for the first. */
final class ShipmentStatus extends Dto
{
    /** @param list<ShipmentTracking|null>|null $shipmentsInfo */
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?int $internalId = null,
        public readonly ?string $shipmentStatus = null,
        #[ListOf(ShipmentTracking::class)]
        public readonly ?array $shipmentsInfo = null,
    ) {
    }
}
