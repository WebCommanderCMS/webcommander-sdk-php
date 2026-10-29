<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The `add to cart` and `view details` buttons on a listing tile, and whether they wait for a hover. */
final class InteractionButtons extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $addToCart = null,
        public readonly ?bool $showViewDetails = null,
        public readonly ?bool $showOnHover = null,
    ) {
    }
}
