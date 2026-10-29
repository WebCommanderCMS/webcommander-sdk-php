<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The `group_meta` block - a single entry for the whole area, not one per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $productListing = null,
    ) {
    }
}
