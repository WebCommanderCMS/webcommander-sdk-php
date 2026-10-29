<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One variation type the product uses, with its options. */
final class ProductVariationType extends Dto
{
    /** @param list<ProductVariationTypeOption|null>|null $options */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $standard = null,
        #[ListOf(ProductVariationTypeOption::class)]
        public readonly ?array $options = null,
    ) {
    }
}
