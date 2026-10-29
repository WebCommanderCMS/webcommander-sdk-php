<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** The count sub-path's body, `{"blogs": {"count": N}}`. */
final class BlogCount extends Dto
{
    public const ENVELOPE_KEY = 'blogs';

    public function __construct(
        public readonly ?int $count = null,
    ) {
    }
}
