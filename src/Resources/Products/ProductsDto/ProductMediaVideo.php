<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One video in the media block. */
final class ProductMediaVideo extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $filename = null,
        public readonly ?int $position = null,
        public readonly ?string $url = null,
        public readonly ?string $thumbnailUrl = null,
    ) {
    }
}
