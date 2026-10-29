<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One location's units in the legacy shape; `warehouse` is the location id as text. */
final class ProductWarehouseStock extends Dto
{
    public function __construct(
        public readonly ?string $warehouse = null,
        public readonly ?int $stock = null,
    ) {
    }
}
