<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One option of a variation type the product uses. */
final class ProductVariationTypeOption extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $label = null,
        public readonly ?string $value = null,
        public readonly ?bool $default = null,
    ) {
    }
}
