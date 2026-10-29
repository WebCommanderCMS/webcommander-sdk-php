<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** One comment's body, from its own path and from each comment write: the blog's `id` beside the
 *  `comment`. An `ENVELOPE_KEY` here would merge that `id` over the comment's own. */
final class BlogCommentEnvelope extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?BlogComment $comment = null,
    ) {
    }
}
