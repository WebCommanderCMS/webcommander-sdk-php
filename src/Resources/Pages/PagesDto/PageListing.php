<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, outside the trash, and where they sit. */
final class PageListing extends Dto
{
    /** @param list<Page|null>|null $pages */
    public function __construct(
        #[ListOf(Page::class)]
        public readonly ?array $pages = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
