<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The stock block of the stock patch's answer. */
final class ProductStockSummary extends Dto
{
    /** @param list<ProductStockLocation|null>|null $locations
     *  @param list<ProductStockVariation|null>|null $variations */
    public function __construct(
        public readonly ?ProductStockTracking $tracking = null,
        public readonly ?bool $multiLocationEnabled = null,
        #[ListOf(ProductStockLocation::class)]
        public readonly ?array $locations = null,
        #[ListOf(ProductStockVariation::class)]
        public readonly ?array $variations = null,
    ) {
    }
}
