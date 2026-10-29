<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** `tax_settings` in one block; `enabled` is `overwrite_default_config`. A write takes
 *  `custom_tax_profile` as an id or `{"id": ...}` of a custom tax profile. */
final class ProductTax extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $exempt = null,
        public readonly ?ProductNamedReference $customTaxProfile = null,
        public readonly ?string $message = null,
        public readonly ?bool $showPriceWithTax = null,
        public readonly ?ProductPriceIncludesTax $priceIncludesTax = null,
    ) {
    }
}
