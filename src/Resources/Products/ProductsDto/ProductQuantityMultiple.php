<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Order in multiples of `multiple_of`. */
final class ProductQuantityMultiple extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?int $multipleOf = null,
    ) {
    }
}
