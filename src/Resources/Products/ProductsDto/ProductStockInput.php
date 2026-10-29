<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The stock write's body: `locations` is required and replaces the product's whole set, so
 *  a location left out is unassigned whatever it holds. */
final class ProductStockInput extends Dto
{
    /** @param list<ProductStockLocationInput|null>|null $locations */
    public function __construct(
        public readonly ?string $note = null,
        #[ListOf(ProductStockLocationInput::class)]
        public readonly ?array $locations = null,
    ) {
    }
}
