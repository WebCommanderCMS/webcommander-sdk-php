<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One shipment as the shipment status lists it. */
final class ShipmentTracking extends Dto
{
    public function __construct(
        public readonly ?string $shippingProvider = null,
        public readonly ?string $trackingNumber = null,
        public readonly ?string $lastUpdated = null,
    ) {
    }
}
