<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** One product line to put on a cart. `$productId` and `$quantity` are required; `$variationId` picks a variation. */
final class AdminCartProductInput extends Dto
{
    public function __construct(
        public readonly ?int $productId = null,
        public readonly ?int $variationId = null,
        public readonly ?int $quantity = null,
    ) {
    }
}
