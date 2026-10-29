<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The order quantity limits; a `max_quantity` of `0` is no maximum. */
final class ProductOrdering extends Dto
{
    public function __construct(
        public readonly ?int $minQuantity = null,
        public readonly ?int $maxQuantity = null,
    ) {
    }
}
