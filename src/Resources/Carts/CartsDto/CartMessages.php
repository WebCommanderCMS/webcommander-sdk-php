<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The cart's `messages` block. */
final class CartMessages extends Dto
{
    public function __construct(
        public readonly ?CartDiscountMessage $discount = null,
    ) {
    }
}
