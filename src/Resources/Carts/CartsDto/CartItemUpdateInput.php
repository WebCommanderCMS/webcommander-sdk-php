<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The line update's body, no envelope; `$cartItemId` and `$quantity` are required. */
final class CartItemUpdateInput extends Dto
{
    public function __construct(
        public readonly ?int $cartItemId = null,
        public readonly ?int $quantity = null,
        public readonly ?CartAddressInput $shippingAddress = null,
        public readonly ?CartAddressInput $billingAddress = null,
    ) {
    }
}
