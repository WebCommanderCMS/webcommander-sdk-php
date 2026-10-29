<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The rating stars on a listing tile and the count beside them. */
final class Reviews extends Dto
{
    public function __construct(
        public readonly ?bool $showRating = null,
        public readonly ?bool $showReviewCount = null,
    ) {
    }
}
