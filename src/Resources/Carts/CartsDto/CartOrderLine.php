<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** One entry of the order's `order_line_details`. */
final class CartOrderLine extends Dto
{
    /** @param list<mixed>|null $variations */
    public function __construct(
        public readonly ?int $itemId = null,
        public readonly ?string $productName = null,
        public readonly ?int $productId = null,
        public readonly ?string $sku = null,
        public readonly ?int $quantity = null,
        public readonly ?float $price = null,
        public readonly ?float $totalAmount = null,
        public readonly ?float $tax = null,
        public readonly ?float $discount = null,
        public readonly ?float $taxDiscount = null,
        public readonly ?bool $isTaxable = null,
        public readonly ?bool $isShippable = null,
        public readonly ?string $imageUrl = null,
        public readonly ?array $variations = null,
        public readonly ?string $serialBatchNumber = null,
    ) {
    }
}
