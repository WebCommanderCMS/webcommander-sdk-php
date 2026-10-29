<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The `sortable_items` section: whether a shopper may re-sort a listing, and by what. */
final class SortableItems extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?SortableOptions $options = null,
    ) {
    }
}
