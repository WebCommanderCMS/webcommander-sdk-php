<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** The `group_meta` block the listing, a row read and a `PATCH` answer carry. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?ResourceMeta $blogs = null,
    ) {
    }
}
