<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Which variant price a listing shows, and the labels it shows it with. `lowest_price_label`
 *  and `highest_price_label` are second names for the two `label_for_*` fields. */
final class ProductVariationPriceDisplay extends Dto
{
    public function __construct(
        public readonly ?string $method = null,
        public readonly ?string $labelForLowestPrice = null,
        public readonly ?string $labelForHighestPrice = null,
        public readonly ?string $lowestPriceLabel = null,
        public readonly ?string $highestPriceLabel = null,
    ) {
    }
}
