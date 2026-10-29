<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations\InventoryLocationsDto;

use WebCommander\Client\Dto;

/** One inventory location, the same seven fields in every form the API sends it. */
final class InventoryLocation extends Dto
{
    public const ENVELOPE_KEY = 'inventory_location';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $address = null,
        public readonly ?bool $active = null,
        public readonly ?bool $default = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
