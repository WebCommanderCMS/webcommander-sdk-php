<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One location's holding of the product; exactly one row of a product holds `is_default`. */
final class ProductStockLocation extends Dto
{
    public function __construct(
        public readonly ?int $warehouse = null,
        public readonly ?string $warehouseName = null,
        public readonly ?int $stock = null,
        public readonly ?int $lowStockLevel = null,
        public readonly ?bool $isDefault = null,
    ) {
    }
}
