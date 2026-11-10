<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The stock patch's answer: the stock now, and the adjustment it recorded. */
final class ProductStockPatchResult extends Dto
{
    public function __construct(
        public readonly ?ProductStockSummary $stock = null,
        public readonly ?ProductStockAdjustment $adjustment = null,
    ) {
    }
}
