<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;

/** A blog the category is linked to, by `id`. */
final class BlogCategoryBlog extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
    ) {
    }
}
