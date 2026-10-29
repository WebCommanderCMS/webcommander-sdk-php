<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The advanced pricing switches. */
final class ProductAdvancedPricing extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?ProductQuantityMultiple $quantityMultiple = null,
        public readonly ?ProductExpectToPay $expectToPay = null,
        public readonly ?bool $callForPrice = null,
    ) {
    }
}
