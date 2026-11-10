<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of a product's stock history. */
final class ProductStockAdjustmentPage extends Dto
{
    /** @param list<ProductStockAdjustment|null>|null $adjustments */
    public function __construct(
        #[ListOf(ProductStockAdjustment::class)]
        public readonly ?array $adjustments = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
