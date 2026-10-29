<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The product ids to assign; a write replaces the whole assignment. */
final class CategoryAssignProductsInput extends Dto
{
    /** @param list<int|null>|null $products */
    public function __construct(
        public readonly ?array $products = null,
    ) {
    }
}
