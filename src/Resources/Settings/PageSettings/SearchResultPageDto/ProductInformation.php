<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The `product_information` section: what each result shows and how the list behaves. */
final class ProductInformation extends Dto
{
    public const ENVELOPE_KEY = 'product_information';

    public function __construct(
        public readonly ?bool $useDefaultProductListingConfigurations = null,
        public readonly ?ProductInteractionButtons $productInteractionButtons = null,
        public readonly ?bool $displayContentPage = null,
        public readonly ?NumberOfSearchesPerResult $numberOfSearchesPerResult = null,
        public readonly ?bool $displayShortDescription = null,
        public readonly ?bool $displayVariationsCombination = null,
        public readonly ?SetProductDisplayPreferences $setProductDisplayPreferences = null,
        public readonly ?SetProductSorting $setProductSorting = null,
        public readonly ?ConfigureSortingOptions $configureSortingOptions = null,
        public readonly ?bool $displayLoyaltyPoints = null,
        public readonly ?DisplayPrice $displayPrice = null,
        public readonly ?string $labelForPrice = null,
    ) {
    }
}
