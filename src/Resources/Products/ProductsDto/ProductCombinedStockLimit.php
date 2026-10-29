<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The combined stock selling limit. */
final class ProductCombinedStockLimit extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?int $units = null,
    ) {
    }
}
