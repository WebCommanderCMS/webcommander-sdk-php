<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `assign_products` section as read. */
final class CategoryAssignProducts extends Dto
{
    /** @param list<CategoryProduct|null>|null $products */
    public function __construct(
        #[ListOf(CategoryProduct::class)]
        public readonly ?array $products = null,
    ) {
    }
}
