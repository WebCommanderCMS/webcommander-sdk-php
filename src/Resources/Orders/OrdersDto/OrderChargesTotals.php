<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The `charges_totals` section; a payment refund lowers `$paid` and an order refund does not. */
final class OrderChargesTotals extends Dto
{
    public function __construct(
        public readonly ?float $subTotal = null,
        public readonly ?float $totalTax = null,
        public readonly ?float $handlingCost = null,
        public readonly ?float $totalSurcharge = null,
        public readonly ?float $otherCharges = null,
        public readonly ?float $grandTotal = null,
        public readonly ?float $paid = null,
        public readonly ?float $due = null,
        public readonly ?float $refunded = null,
        public readonly ?string $refundStatus = null,
        public readonly ?int $itemsTotal = null,
    ) {
    }
}
