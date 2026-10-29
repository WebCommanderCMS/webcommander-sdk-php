<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The variation block; `{}` on a product with no variations, so every field reads null. */
final class ProductVariation extends Dto
{
    /** @param list<ProductVariationType|null>|null $types
     *  @param list<ProductCombination|null>|null $availableCombinations */
    public function __construct(
        #[ListOf(ProductVariationType::class)]
        public readonly ?array $types = null,
        #[ListOf(ProductCombination::class)]
        public readonly ?array $availableCombinations = null,
    ) {
    }
}
