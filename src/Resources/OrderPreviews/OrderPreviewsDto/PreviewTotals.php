<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The money. `$grandTotal` is `$subTotal` less `$totalDiscount` plus the tax, shipping (and its tax), handling and surcharge; a gift card lowers `$due`, not `$grandTotal`. */
final class PreviewTotals extends Dto
{
    public function __construct(
        public readonly ?float $subTotal = null,
        public readonly ?float $totalDiscount = null,
        public readonly ?float $totalTax = null,
        public readonly ?float $shippingCost = null,
        public readonly ?float $handlingCost = null,
        public readonly ?float $totalSurcharge = null,
        public readonly ?float $giftCardApplied = null,
        public readonly ?float $grandTotal = null,
        public readonly ?float $due = null,
    ) {
    }
}
