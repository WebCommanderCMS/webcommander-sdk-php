<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, with the `field_metadata` block when it was asked for. */
final class CategoryPage extends Dto
{
    /** @param list<Category|null>|null $categories */
    public function __construct(
        #[ListOf(Category::class)]
        public readonly ?array $categories = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly ?Pagination $pagination = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
