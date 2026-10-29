<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Dimensions as written; the top level of the product repeats the four numbers read-only. */
final class ProductProperties extends Dto
{
    public function __construct(
        public readonly ?float $length = null,
        public readonly ?float $width = null,
        public readonly ?float $height = null,
        public readonly ?float $weight = null,
        public readonly ?string $lengthUnit = null,
        public readonly ?string $weightUnit = null,
    ) {
    }
}
