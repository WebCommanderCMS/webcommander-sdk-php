<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The media order's answer: the product's images in their new order. */
final class ProductMediaOrder extends Dto
{
    /** @param list<ProductMediaImage|null>|null $images */
    public function __construct(
        #[ListOf(ProductMediaImage::class)]
        public readonly ?array $images = null,
    ) {
    }
}
