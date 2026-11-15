<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** One line, priced by the store. `$cartItemId` is what the line's update and delete take; a replace of the cart numbers its lines again. */
final class AdminCartItem extends Dto
{
    public function __construct(
        public readonly ?int $cartItemId = null,
        public readonly ?int $productId = null,
        public readonly ?string $productName = null,
        public readonly ?int $variationId = null,
        public readonly ?string $variationName = null,
        public readonly ?string $sku = null,
        public readonly ?float $price = null,
        public readonly ?int $quantity = null,
        public readonly ?float $discount = null,
        public readonly ?float $tax = null,
        public readonly ?float $totalAmount = null,
        public readonly ?bool $taxable = null,
        public readonly ?bool $shippable = null,
    ) {
    }
}
