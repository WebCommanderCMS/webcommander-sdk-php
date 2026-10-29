<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `actions_buttons` block: which buttons a product page carries. */
final class ActionButtons extends Dto
{
    public function __construct(
        public readonly ?bool $showProductActionButtons = null,
        public readonly ?bool $displayAddToCartButton = null,
        public readonly ?bool $displayBuyNowButton = null,
        public readonly ?bool $displayOnHover = null,
        public readonly ?bool $displayAddToCompareButton = null,
        public readonly ?bool $displayAddToWishlistButton = null,
    ) {
    }
}
