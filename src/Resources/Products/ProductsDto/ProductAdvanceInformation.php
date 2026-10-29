<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Identifiers and origin; `mpn`, `upc`, `barcode` and `hs_code` are written here, not at
 *  the top level, which refuses them. */
final class ProductAdvanceInformation extends Dto
{
    public function __construct(
        public readonly ?string $globalTradeItemNumber = null,
        public readonly ?bool $enableProductIdentifiers = null,
        public readonly ?string $gtin = null,
        public readonly ?string $mpn = null,
        public readonly ?string $upc = null,
        public readonly ?string $barcode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $hsCode = null,
        public readonly ?string $productCondition = null,
        public readonly ?string $model = null,
    ) {
    }
}
