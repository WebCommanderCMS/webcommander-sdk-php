<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** `product_properties` again; the two units are read-only here. */
final class ProductDimension extends Dto
{
    public function __construct(
        public readonly ?string $lengthUnit = null,
        public readonly ?string $weightUnit = null,
        public readonly ?float $width = null,
        public readonly ?float $height = null,
        public readonly ?float $length = null,
        public readonly ?float $weight = null,
    ) {
    }
}
