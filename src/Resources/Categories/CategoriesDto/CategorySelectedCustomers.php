<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** Who `available_for: "selected"` admits, each customer and group read as `{id, name}`. */
final class CategorySelectedCustomers extends Dto
{
    /** @param list<CategoryReference|null>|null $customers
     *  @param list<CategoryReference|null>|null $groups */
    public function __construct(
        #[ListOf(CategoryReference::class)]
        public readonly ?array $customers = null,
        #[ListOf(CategoryReference::class)]
        public readonly ?array $groups = null,
    ) {
    }
}
