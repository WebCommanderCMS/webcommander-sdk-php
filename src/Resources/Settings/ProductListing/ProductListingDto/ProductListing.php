<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The area's body, all four sections under `product_listing`, the only wrapper the `PATCH` takes.
 *  A section type has no envelope of its own, since a bare section body is refused. */
final class ProductListing extends Dto
{
    public const ENVELOPE_KEY = 'product_listing';

    public function __construct(
        public readonly ?ProductInformation $productInformation = null,
        public readonly ?Load $load = null,
        public readonly ?Sorting $sorting = null,
        public readonly ?SortableItems $sortableItems = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
