<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** A category a blog is filed under. */
final class BlogCategoryReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $isDisposable = null,
        public readonly ?bool $isInTrash = null,
    ) {
    }
}
