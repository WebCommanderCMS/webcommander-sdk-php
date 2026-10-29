<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, `group_meta`, the paging block and any schema. */
final class BlogPage extends Dto
{
    /** @param list<Blog|null>|null $blogs */
    public function __construct(
        #[ListOf(Blog::class)]
        public readonly ?array $blogs = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly ?Pagination $pagination = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
