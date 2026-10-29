<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations\InventoryLocationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The stock sub-path's body: the location, its items and their pagination. */
final class InventoryLocationStock extends Dto
{
    /** @param list<InventoryLocationStockItem|null>|null $items */
    public function __construct(
        public readonly ?InventoryLocation $inventoryLocation = null,
        #[ListOf(InventoryLocationStockItem::class)]
        public readonly ?array $items = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
