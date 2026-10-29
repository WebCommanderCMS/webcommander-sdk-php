<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The `general` section as read. */
final class CategoryGeneral extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $title = null,
        public readonly ?string $sku = null,
        public readonly ?string $url = null,
        public readonly ?string $heading = null,
        public readonly ?CategoryReference $parentCategory = null,
        public readonly mixed $filterProfile = null,
        public readonly ?CategoryReference $layout = null,
        public readonly ?string $summary = null,
    ) {
    }
}
