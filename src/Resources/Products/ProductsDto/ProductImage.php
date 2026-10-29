<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One product image. */
final class ProductImage extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $filename = null,
        public readonly ?string $altText = null,
        public readonly ?string $thumbnail = null,
        public readonly ?string $link = null,
    ) {
    }
}
