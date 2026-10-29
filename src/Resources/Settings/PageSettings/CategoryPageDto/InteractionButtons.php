<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `interaction_buttons` block: which buttons each product card carries. */
final class InteractionButtons extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $addToCart = null,
        public readonly ?bool $viewDetails = null,
        public readonly ?bool $showOnHover = null,
        public readonly ?bool $addToWishList = null,
        public readonly ?bool $addToCompare = null,
        public readonly ?bool $quickView = null,
    ) {
    }
}
