<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** The comment a create sends: `$content` required, at most 1000 characters; `$name`, 2 to 100
 *  once trimmed, and `$email` may be left out. */
final class BlogCommentDraft extends Dto
{
    public function __construct(
        public readonly ?string $content = null,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
    ) {
    }
}
