<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** Which orders a shopper may pick from. */
final class SortableOptions extends Dto
{
    public function __construct(
        public readonly ?bool $alphabetic = null,
        public readonly ?bool $featured = null,
        public readonly ?bool $new = null,
        public readonly ?bool $topSelling = null,
        public readonly ?bool $price = null,
        public readonly ?bool $createdDate = null,
    ) {
    }
}
