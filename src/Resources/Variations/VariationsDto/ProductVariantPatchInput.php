<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** The single-variant patch's body, no envelope; partial. The variant is turned on or off as `available`. */
final class ProductVariantPatchInput extends Dto
{
    public function __construct(
        public readonly ?bool $available = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?string $customSku = null,
        public readonly ?string $barcode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $hsCode = null,
        public readonly ?ProductVariantPricing $pricing = null,
        public readonly ?ProductVariantInventory $inventory = null,
        public readonly ?ProductVariantOrdering $ordering = null,
    ) {
    }
}
