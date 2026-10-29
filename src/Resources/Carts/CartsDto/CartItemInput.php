<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The add's body, no envelope; `$customerId` takes the customer's `internal_id`. */
final class CartItemInput extends Dto
{
    public function __construct(
        public readonly ?int $productId = null,
        public readonly ?int $quantity = null,
        public readonly ?int $customerId = null,
        public readonly ?string $sessionId = null,
        public readonly ?CartAddressInput $shippingAddress = null,
    ) {
    }
}
