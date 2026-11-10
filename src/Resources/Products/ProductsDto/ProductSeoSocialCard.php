<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The title, description and image one network shows for the product. */
final class ProductSeoSocialCard extends Dto
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?string $imageUrl = null,
    ) {
    }
}
