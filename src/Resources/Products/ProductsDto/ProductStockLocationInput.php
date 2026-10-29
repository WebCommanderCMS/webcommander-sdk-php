<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One row of the stock write. An unset `$lowStockLevel` is stored null; with no row marked
 *  `is_default`, the first row sent becomes the default. */
final class ProductStockLocationInput extends Dto
{
    public function __construct(
        public readonly ?int $warehouse = null,
        public readonly ?int $stock = null,
        public readonly ?int $lowStockLevel = null,
        public readonly ?bool $isDefault = null,
    ) {
    }
}
