<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One category the product is filed under, as `categories` lists it; `parents` again. */
final class ProductCategory extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $inTrash = null,
        public readonly ?bool $parentInTrash = null,
        public readonly ?bool $disposable = null,
    ) {
    }
}
