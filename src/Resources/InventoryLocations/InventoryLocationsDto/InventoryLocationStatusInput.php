<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations\InventoryLocationsDto;

use WebCommander\Client\Dto;

/** The status sub-path's bare body; `$active` is required and the only field accepted. */
final class InventoryLocationStatusInput extends Dto
{
    public function __construct(
        public readonly ?bool $active = null,
    ) {
    }
}
