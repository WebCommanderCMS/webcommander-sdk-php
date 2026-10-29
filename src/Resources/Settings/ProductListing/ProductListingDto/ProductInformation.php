<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The `product_information` section: what each product shows on a listing tile. */
final class ProductInformation extends Dto
{
    public function __construct(
        public readonly ?InteractionButtons $interactionButtons = null,
        public readonly ?bool $showSummary = null,
        public readonly ?bool $showSalePercentage = null,
        public readonly ?bool $showStockAvailability = null,
        public readonly ?bool $showParentCategory = null,
        public readonly ?bool $showLoyaltyPoints = null,
        public readonly ?ListingPrice $price = null,
        public readonly ?Reviews $reviews = null,
        public readonly ?VariationCombination $variationCombination = null,
        public readonly ?bool $showVariationsAsProducts = null,
    ) {
    }
}
