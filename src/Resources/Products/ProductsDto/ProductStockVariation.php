<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One variant's stock on a product with variations; `locations` was `[]` on every one read. */
final class ProductStockVariation extends Dto
{
    /** @param list<ProductStockLocation|null>|null $locations */
    public function __construct(
        public readonly ?int $variationId = null,
        public readonly ?int $productId = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?int $availableStock = null,
        #[ListOf(ProductStockLocation::class)]
        public readonly ?array $locations = null,
    ) {
    }
}
