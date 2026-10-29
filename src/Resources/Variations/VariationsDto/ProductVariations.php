<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The product read's body; `$variations` is empty for a product without variants. */
final class ProductVariations extends Dto
{
    /** @param list<ProductVariationGroup|null>|null $variations */
    public function __construct(
        #[ListOf(ProductVariationGroup::class)]
        public readonly ?array $variations = null,
    ) {
    }
}
