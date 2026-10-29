<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One option of a combination; `type` is a list of one type. */
final class ProductCombinationOption extends Dto
{
    /** @param list<ProductCombinationOptionType|null>|null $type */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $index = null,
        #[ListOf(ProductCombinationOptionType::class)]
        public readonly ?array $type = null,
        public readonly ?string $label = null,
        public readonly ?string $value = null,
        public readonly ?bool $colorHasSwatch = null,
        public readonly ?string $colorSwatchValue = null,
        public readonly ?string $imageBaseUrl = null,
    ) {
    }
}
