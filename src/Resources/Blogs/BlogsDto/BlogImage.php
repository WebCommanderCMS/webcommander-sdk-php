<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** A blog's cover image. */
final class BlogImage extends Dto
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $alternativeText = null,
        public readonly ?string $fileName = null,
        public readonly ?string $link = null,
    ) {
    }
}
