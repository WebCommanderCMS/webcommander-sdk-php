<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The `product_interaction_buttons` block: which buttons each result carries. */
final class ProductInteractionButtons extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $displayAddToCartButton = null,
        public readonly ?bool $displayAddToCompareButton = null,
        public readonly ?bool $displayAddToWishlistButton = null,
        public readonly ?bool $displayViewDetailsButton = null,
        public readonly ?bool $displayOnHover = null,
        public readonly ?bool $displayQuickViewButton = null,
    ) {
    }
}
