<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** One assigned product, as `assign_products` reads it. */
final class CategoryProduct extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
    ) {
    }
}
