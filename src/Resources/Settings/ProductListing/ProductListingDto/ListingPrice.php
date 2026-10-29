<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** Which prices a listing tile shows; not named `Price`, which `sortable_items` uses as a boolean. */
final class ListingPrice extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $expectToPay = null,
        public readonly ?bool $expectToPayWithTax = null,
    ) {
    }
}
