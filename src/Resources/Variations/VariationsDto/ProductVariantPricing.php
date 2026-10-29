<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** A variant's prices; the bulk write's full answer carries the first four fields. */
final class ProductVariantPricing extends Dto
{
    public function __construct(
        public readonly ?float $basePrice = null,
        public readonly ?float $costPrice = null,
        public readonly ?float $salePrice = null,
        public readonly ?bool $isOnSale = null,
        public readonly ?string $saleAmountType = null,
        public readonly ?bool $hidePrice = null,
        public readonly ?bool $isCallForPrice = null,
        public readonly ?ProductVariantExpectToPay $expectToPay = null,
        public readonly mixed $tieredPricing = null,
    ) {
    }
}
