<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** A product's variants, under `product_key`: its type names joined with `/`. */
final class ProductVariationGroup extends Dto
{
    /** @param list<ProductVariant|null>|null $variants */
    public function __construct(
        public readonly ?string $productKey = null,
        #[ListOf(ProductVariant::class)]
        public readonly ?array $variants = null,
    ) {
    }
}
