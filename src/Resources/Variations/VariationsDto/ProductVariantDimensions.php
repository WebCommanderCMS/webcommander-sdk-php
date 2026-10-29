<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** A variant's size and weight. */
final class ProductVariantDimensions extends Dto
{
    public function __construct(
        public readonly ?float $length = null,
        public readonly ?float $width = null,
        public readonly ?float $height = null,
        public readonly ?float $weight = null,
    ) {
    }
}
