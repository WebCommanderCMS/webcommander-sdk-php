<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One line to order, by the product's `id`. */
final class OrderProductInput extends Dto
{
    public function __construct(
        public readonly ?int $productId = null,
        public readonly ?int $quantity = null,
    ) {
    }
}
