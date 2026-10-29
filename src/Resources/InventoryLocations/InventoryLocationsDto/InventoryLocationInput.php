<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations\InventoryLocationsDto;

use WebCommander\Client\Dto;

/** The body the create, the update and the patch take, bare. The update is a replace: an unset
 *  `$address` is cleared and an unset `$active` reads true, while an unset `$default` is kept. The
 *  patch keeps every field left unset. */
final class InventoryLocationInput extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $address = null,
        public readonly ?bool $active = null,
        public readonly ?bool $default = null,
    ) {
    }
}
