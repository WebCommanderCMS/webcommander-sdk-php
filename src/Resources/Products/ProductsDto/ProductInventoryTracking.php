<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Stock tracking; `suppliers` echoes the ids written. */
final class ProductInventoryTracking extends Dto
{
    /** @param list<mixed>|null $suppliers */
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $lowStockLevel = null,
        public readonly ?array $suppliers = null,
    ) {
    }
}
