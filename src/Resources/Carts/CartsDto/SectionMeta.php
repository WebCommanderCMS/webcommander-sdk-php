<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The one entry of `group_meta`. */
final class SectionMeta extends Dto
{
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?bool $writable = null,
        public readonly ?string $href = null,
    ) {
    }
}
