<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The cart's `totals`; `$subtotal` sums each line's `unit_price` times its quantity. */
final class CartTotals extends Dto
{
    public function __construct(
        public readonly ?float $subtotal = null,
        public readonly ?float $discount = null,
        public readonly ?float $shippingDiscount = null,
        public readonly ?float $tax = null,
        public readonly ?float $total = null,
        public readonly ?float $grandTotal = null,
        public readonly ?float $paid = null,
    ) {
    }
}
