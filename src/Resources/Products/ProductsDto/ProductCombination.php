<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One option combination and the variant it makes. */
final class ProductCombination extends Dto
{
    /** @param list<ProductCombinationOption|null>|null $options */
    public function __construct(
        #[ListOf(ProductCombinationOption::class)]
        public readonly ?array $options = null,
        public readonly ?ProductCombinationDetails $details = null,
    ) {
    }
}
