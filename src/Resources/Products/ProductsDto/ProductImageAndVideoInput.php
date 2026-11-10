<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `image_and_video` block of an image upload. */
final class ProductImageAndVideoInput extends Dto
{
    /** @param list<ProductImageFileInput|null>|null $images */
    public function __construct(
        #[ListOf(ProductImageFileInput::class)]
        public readonly ?array $images = null,
    ) {
    }
}
