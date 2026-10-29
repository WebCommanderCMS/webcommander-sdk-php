<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Whether `base_price` includes tax, and how it is rounded. */
final class ProductPriceIncludesTax extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $basePriceRounding = null,
    ) {
    }
}
