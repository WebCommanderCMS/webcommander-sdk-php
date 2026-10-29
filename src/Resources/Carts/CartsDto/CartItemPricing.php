<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** One line's `pricing`. */
final class CartItemPricing extends Dto
{
    public function __construct(
        public readonly ?float $unitPrice = null,
        public readonly ?float $displayUnitPrice = null,
        public readonly ?float $total = null,
        public readonly ?float $discount = null,
        public readonly ?float $discountTax = null,
        public readonly ?float $tax = null,
    ) {
    }
}
