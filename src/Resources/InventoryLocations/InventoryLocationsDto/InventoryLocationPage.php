<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations\InventoryLocationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. */
final class InventoryLocationPage extends Dto
{
    /** @param list<InventoryLocation|null>|null $inventoryLocations */
    public function __construct(
        #[ListOf(InventoryLocation::class)]
        public readonly ?array $inventoryLocations = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
