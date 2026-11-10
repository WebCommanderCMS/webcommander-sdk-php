<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One row of a special listing: a product's storefront prices. */
final class ProductSpecial extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $sku = null,
        public readonly ?string $name = null,
        public readonly ?string $image = null,
        public readonly ?float $basePrice = null,
        public readonly ?bool $isOnSale = null,
        public readonly ?string $onSaleAmountType = null,
        public readonly ?float $effectivePrice = null,
        public readonly ?float $actualBasePrice = null,
        public readonly ?float $onSaleAmount = null,
        public readonly ?float $expectToPayPrice = null,
        public readonly ?float $expectToPayPriceWithTax = null,
        public readonly ?float $taxExclusiveBasePrice = null,
        public readonly ?float $taxExclusiveSalePrice = null,
        public readonly ?float $tax = null,
        public readonly ?float $previousPriceToDisplay = null,
        public readonly ?float $actualPriceToDisplay = null,
        public readonly ?float $salePrice = null,
        public readonly ?string $updated = null,
        public readonly ?string $url = null,
        public readonly ?string $summary = null,
        public readonly ?string $description = null,
    ) {
    }
}
