<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The flags in blocks: `is_featured`, `is_new`, `sold_out` and `model` again. `sold_out` is
 *  read-only. */
final class ProductFlags extends Dto
{
    public function __construct(
        public readonly ?ProductFlag $featured = null,
        public readonly ?bool $newProduct = null,
        public readonly ?ProductFlag $soldOut = null,
        public readonly ?string $modelNumber = null,
    ) {
    }
}
