<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One group to import: `product_key` names the types, joined with `/`, and `variants` must not be
 *  empty. A type name the store has is reused, an option label it lacks is added. */
final class ProductVariationGroupInput extends Dto
{
    /** @param list<ProductVariantInput|null>|null $variants */
    public function __construct(
        public readonly ?string $productKey = null,
        #[ListOf(ProductVariantInput::class)]
        public readonly ?array $variants = null,
    ) {
    }
}
