<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The media block. */
final class ProductImageAndVideo extends Dto
{
    /** @param list<ProductImage|null>|null $images
     *  @param list<ProductVideo|null>|null $videos
     *  @param list<mixed>|null $specs */
    public function __construct(
        #[ListOf(ProductImage::class)]
        public readonly ?array $images = null,
        #[ListOf(ProductVideo::class)]
        public readonly ?array $videos = null,
        public readonly ?array $specs = null,
    ) {
    }
}
