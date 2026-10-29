<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The cart's `shipping` block; its two taxes follow the shipping address's country. */
final class CartShipping extends Dto
{
    public function __construct(
        public readonly ?float $cost = null,
        public readonly ?float $handlingFee = null,
        public readonly ?float $handlingTax = null,
        public readonly ?float $shippingTax = null,
        public readonly ?float $totalTax = null,
    ) {
    }
}
