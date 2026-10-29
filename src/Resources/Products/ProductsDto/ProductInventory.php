<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Stock in one block; `preorder` is `preorder_enabled`. */
final class ProductInventory extends Dto
{
    public function __construct(
        public readonly ?ProductInventoryTracking $tracking = null,
        public readonly ?ProductCombinedStockLimit $combinedStockLimit = null,
        public readonly ?bool $preorder = null,
    ) {
    }
}
