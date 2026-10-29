<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. The resource serves no field schema: `field_metadata` adds no key. */
final class BlogCategoryPage extends Dto
{
    /** @param list<BlogCategory|null>|null $blogCategories */
    public function __construct(
        #[ListOf(BlogCategory::class)]
        public readonly ?array $blogCategories = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
