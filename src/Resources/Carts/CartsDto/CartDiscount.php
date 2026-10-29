<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The cart's `discount` block. */
final class CartDiscount extends Dto
{
    public function __construct(
        public readonly ?float $discount = null,
        public readonly ?float $orderDiscount = null,
        public readonly ?float $shippingDiscount = null,
        public readonly ?float $discountOnTax = null,
        public readonly ?float $discountOnShippingTax = null,
    ) {
    }
}
