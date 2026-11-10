<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** A product's stock figure and low-stock level, with whether tracking is on. */
final class ProductStockTracking extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $lowStockLevel = null,
    ) {
    }
}
