<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The top-up's body, `{"product": {"product_pricing_and_stock": {...}}}`. */
final class ProductInventoryInput extends Dto
{
    public const ENVELOPE_KEY = 'product';

    public function __construct(
        public readonly ?ProductInventoryStockInput $productPricingAndStock = null,
    ) {
    }
}
