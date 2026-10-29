<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The comments sub-path's body: the blog's `id` beside every comment it holds, unpaged. */
final class BlogCommentList extends Dto
{
    /** @param list<BlogComment|null>|null $comments */
    public function __construct(
        public readonly ?int $id = null,
        #[ListOf(BlogComment::class)]
        public readonly ?array $comments = null,
    ) {
    }
}
