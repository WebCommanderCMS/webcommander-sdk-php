<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One category the product is filed under. */
final class ProductParent extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $isInTrash = null,
        public readonly ?bool $isParentInTrash = null,
        public readonly ?bool $isDisposable = null,
    ) {
    }
}
