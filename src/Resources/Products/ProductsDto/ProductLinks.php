<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** API paths of the product and its sub-paths, read-only. */
final class ProductLinks extends Dto
{
    public function __construct(
        public readonly ?string $self = null,
        public readonly ?string $variations = null,
        public readonly ?string $stock = null,
        public readonly ?string $reviews = null,
    ) {
    }
}
