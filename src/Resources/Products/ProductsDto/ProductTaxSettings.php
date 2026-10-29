<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Per-product tax overrides, applied only when `overwrite_default_config` is true. */
final class ProductTaxSettings extends Dto
{
    public function __construct(
        public readonly ?bool $overwriteDefaultConfig = null,
        public readonly ?bool $isTaxExempt = null,
        public readonly ?bool $showPriceWithTax = null,
        public readonly ?bool $isPriceWithTax = null,
        public readonly ?bool $systemDefaultTax = null,
        public readonly ?string $taxMessage = null,
        public readonly ?string $basePriceRounding = null,
        public readonly ?string $defaultTaxCode = null,
        public readonly ?string $customTaxProfileId = null,
    ) {
    }
}
