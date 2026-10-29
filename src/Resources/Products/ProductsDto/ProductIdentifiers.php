<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** `advance_information` again: a write here changes it there, `condition` being its
 *  `product_condition`. */
final class ProductIdentifiers extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $gtin = null,
        public readonly ?string $condition = null,
        public readonly ?string $barcode = null,
        public readonly ?string $hsCode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $mpn = null,
        public readonly ?string $upc = null,
    ) {
    }
}
