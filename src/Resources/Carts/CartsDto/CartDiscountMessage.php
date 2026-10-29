<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The `discount` entry of `messages`. */
final class CartDiscountMessage extends Dto
{
    public function __construct(
        public readonly ?string $message = null,
        public readonly mixed $status = null,
    ) {
    }
}
