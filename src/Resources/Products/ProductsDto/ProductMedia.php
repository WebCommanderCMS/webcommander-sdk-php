<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The media block. A write names files the product already holds, by `id`; another id is
 *  `400`. `specification_file` was `null` on every product read, so it is not typed. */
final class ProductMedia extends Dto
{
    /** @param list<ProductMediaImage|null>|null $images
     *  @param list<ProductMediaVideo|null>|null $videos */
    public function __construct(
        #[ListOf(ProductMediaImage::class)]
        public readonly ?array $images = null,
        #[ListOf(ProductMediaVideo::class)]
        public readonly ?array $videos = null,
        public readonly mixed $specificationFile = null,
    ) {
    }
}
