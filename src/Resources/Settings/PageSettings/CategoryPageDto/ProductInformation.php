<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `product_information` section: what each product card shows and how the listing behaves. */
final class ProductInformation extends Dto
{
    public const ENVELOPE_KEY = 'product_information';

    public function __construct(
        public readonly ?bool $useGlobalDefaults = null,
        public readonly ?InteractionButtons $interactionButtons = null,
        public readonly ?bool $showSummary = null,
        public readonly ?bool $showSalePercentage = null,
        public readonly ?bool $showStockAvailability = null,
        public readonly ?bool $showParentCategory = null,
        public readonly ?Price $price = null,
        public readonly ?VariationCombination $variationCombination = null,
        public readonly ?Rating $rating = null,
        public readonly ?ViewSwitcher $viewSwitcher = null,
        public readonly ?DefaultDisplay $defaultDisplay = null,
        public readonly ?ProductLoad $load = null,
        public readonly ?DefaultSort $defaultSort = null,
        public readonly ?SortOptions $sortOptions = null,
    ) {
    }
}
