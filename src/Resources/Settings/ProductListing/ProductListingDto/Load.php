<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The `load` section: whether a listing pages or loads more, and that mode's settings. */
final class Load extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $type = null,
        public readonly ?Pagination $pagination = null,
        public readonly ?LoadMore $loadMore = null,
    ) {
    }
}
