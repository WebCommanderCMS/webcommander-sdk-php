<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** The stored image; a write sends a base64 or `data:` URI string, and null removes it. */
final class CustomerGroupBackgroundImage extends Dto
{
    public function __construct(
        public readonly ?string $url = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
    ) {
    }
}
