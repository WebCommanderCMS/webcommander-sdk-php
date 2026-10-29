<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One image in the media block. */
final class ProductMediaImage extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $filename = null,
        public readonly ?int $position = null,
        public readonly ?bool $primary = null,
        public readonly ?string $altText = null,
        public readonly ?string $url = null,
        public readonly ?string $thumbnailUrl = null,
    ) {
    }
}
