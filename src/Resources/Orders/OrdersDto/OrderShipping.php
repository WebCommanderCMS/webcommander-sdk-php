<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The `shipping` section; `$shippingType` is the first shipment's method. */
final class OrderShipping extends Dto
{
    public function __construct(
        public readonly ?string $deliveryType = null,
        public readonly ?string $shippingType = null,
        public readonly ?string $shippingStatus = null,
        public readonly ?float $shippingCost = null,
        public readonly ?float $shippingTax = null,
    ) {
    }
}
