<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `quick_view` section: the quick-view popup and what it shows. */
final class QuickView extends Dto
{
    public const ENVELOPE_KEY = 'quick_view';

    public function __construct(
        public readonly ?bool $productQuickView = null,
        public readonly ?bool $displayProductName = null,
        public readonly ?bool $displaySku = null,
        public readonly ?bool $displayProductRating = null,
        public readonly ?bool $displayProductStock = null,
        public readonly ?bool $displayProductVariation = null,
        public readonly ?bool $displayProductImage = null,
        public readonly ?bool $displayVariationImage = null,
        public readonly ?bool $displayProductSummary = null,
        public readonly ?bool $displayAddToCartButton = null,
        public readonly ?bool $displayAddToCompareButton = null,
        public readonly ?bool $displayAddToWishlistButton = null,
    ) {
    }
}
