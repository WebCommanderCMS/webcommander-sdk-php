<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** A variant's pricing and stock block. */
final class ProductCombinationPriceAndStock extends Dto
{
    public function __construct(
        public readonly ?bool $trackInventory = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $lowLevelStock = null,
        public readonly ?int $minimumOrderQuantity = null,
        public readonly ?int $maximumOrderQuantity = null,
        public readonly ?int $supportedMaxOrderQuantity = null,
        public readonly ?bool $enableMultipleOrder = null,
        public readonly ?int $multipleOrderQuantity = null,
        public readonly ?bool $onSale = null,
        public readonly ?bool $soldOut = null,
        public readonly ?string $soldOutLabel = null,
        public readonly ?string $onSalePriceType = null,
        public readonly ?float $onSalePrice = null,
        public readonly ?bool $expectedToPay = null,
        public readonly ?float $expectedToPayPrice = null,
        public readonly ?bool $enableCallForPrice = null,
        public readonly ?bool $hidePrice = null,
    ) {
    }
}
