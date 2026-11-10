<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The stock figures a top-up writes. */
final class ProductInventoryStockInput extends Dto
{
    public function __construct(
        public readonly ?bool $trackInventory = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $lowLevelStock = null,
    ) {
    }
}
