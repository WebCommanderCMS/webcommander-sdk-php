<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** The comment create's body, `{"blog": {"comment": {...}}}`. */
final class BlogCommentInput extends Dto
{
    public const ENVELOPE_KEY = 'blog';

    public function __construct(
        public readonly ?BlogCommentDraft $comment = null,
    ) {
    }
}
