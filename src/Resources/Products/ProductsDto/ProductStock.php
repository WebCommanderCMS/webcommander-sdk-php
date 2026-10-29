<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The stock sub-path's body, read and written. `available_stock` is the sum of the rows'
 *  `stock`; `variations` is there only on a product with variations. */
final class ProductStock extends Dto
{
    /** @param list<ProductStockLocation|null>|null $locations
     *  @param list<ProductStockVariation|null>|null $variations */
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $productId = null,
        public readonly ?bool $multiLocationEnabled = null,
        public readonly ?bool $trackInventory = null,
        public readonly ?int $availableStock = null,
        #[ListOf(ProductStockLocation::class)]
        public readonly ?array $locations = null,
        #[ListOf(ProductStockVariation::class)]
        public readonly ?array $variations = null,
    ) {
    }
}
