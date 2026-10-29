<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;

/** A category's image. */
final class BlogCategoryImage extends Dto
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $alternativeText = null,
        public readonly ?string $fileName = null,
        public readonly ?string $link = null,
    ) {
    }
}
