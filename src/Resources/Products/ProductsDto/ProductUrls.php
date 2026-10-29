<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The product's slug and its absolute storefront address. */
final class ProductUrls extends Dto
{
    public function __construct(
        public readonly ?string $url = null,
        public readonly ?string $productUrl = null,
    ) {
    }
}
