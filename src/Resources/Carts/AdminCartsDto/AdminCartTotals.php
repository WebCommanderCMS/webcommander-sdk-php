<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The cart's money before shipping. */
final class AdminCartTotals extends Dto
{
    public function __construct(
        public readonly ?float $subTotal = null,
        public readonly ?float $totalDiscount = null,
        public readonly ?float $totalTax = null,
        public readonly ?float $grandTotal = null,
    ) {
    }
}
