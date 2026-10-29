<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations\InventoryLocationsDto;

use WebCommander\Client\Dto;

/** The product one stock item belongs to. */
final class InventoryLocationStockProduct extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
    ) {
    }
}
