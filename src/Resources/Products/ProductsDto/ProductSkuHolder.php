<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The product that holds a SKU; `$status` is `trashed` for one in the trash. */
final class ProductSkuHolder extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $status = null,
    ) {
    }
}
