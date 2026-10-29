<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** One line of the cart; `$id` is the `cart_item_id` the line's writes take. */
final class CartItem extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $quantity = null,
        public readonly mixed $variations = null,
        public readonly ?bool $taxable = null,
        public readonly ?bool $shippable = null,
        public readonly ?CartItemPricing $pricing = null,
        public readonly ?CartItemProduct $product = null,
    ) {
    }
}
