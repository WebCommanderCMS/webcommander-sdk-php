<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations\InventoryLocationsDto;

use WebCommander\Client\Dto;

/** One product's holding at a location; `$defaultForProduct` is the product's flag, not the
 *  location's. */
final class InventoryLocationStockItem extends Dto
{
    public function __construct(
        public readonly ?InventoryLocationStockProduct $product = null,
        public readonly mixed $variation = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $lowStockLevel = null,
        public readonly ?bool $defaultForProduct = null,
    ) {
    }
}
