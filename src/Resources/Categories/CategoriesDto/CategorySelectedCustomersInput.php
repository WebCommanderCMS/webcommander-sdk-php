<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The ids `available_for: "selected"` admits. */
final class CategorySelectedCustomersInput extends Dto
{
    /** @param list<int|null>|null $customers
     *  @param list<int|null>|null $groups */
    public function __construct(
        public readonly ?array $customers = null,
        public readonly ?array $groups = null,
    ) {
    }
}
