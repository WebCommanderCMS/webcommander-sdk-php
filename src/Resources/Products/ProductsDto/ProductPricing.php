<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Prices in one block; `rrp_price` is `compare_at_price`. On a create `base_price` here stands
 *  in for the top-level one. */
final class ProductPricing extends Dto
{
    public function __construct(
        public readonly ?float $basePrice = null,
        public readonly ?float $costPrice = null,
        public readonly ?float $rrpPrice = null,
        public readonly ?ProductOnSale $onSale = null,
        public readonly ?ProductAdvancedPricing $advancedPricing = null,
    ) {
    }
}
