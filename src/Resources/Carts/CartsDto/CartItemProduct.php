<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The product one line holds; `$availableStock` is the product's, not the line's. */
final class CartItemProduct extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $sku = null,
        public readonly ?float $basePrice = null,
        public readonly ?int $availableStock = null,
        public readonly ?bool $onSale = null,
        public readonly ?float $costPrice = null,
        public readonly ?float $salePrice = null,
        public readonly ?string $url = null,
        public readonly ?string $name = null,
        public readonly ?string $productType = null,
        public readonly ?string $imageLink = null,
    ) {
    }
}
