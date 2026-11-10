<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** The variant as the single-variant patch answers it: its ids and codes. */
final class ProductVariantPatched extends Dto
{
    public function __construct(
        public readonly ?int $variationId = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?string $customSku = null,
        public readonly ?string $barcode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $hsCode = null,
    ) {
    }
}
