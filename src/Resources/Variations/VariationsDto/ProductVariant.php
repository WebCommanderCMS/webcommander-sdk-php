<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** One variant of a product; `$key` joins its option labels with `/`. */
final class ProductVariant extends Dto
{
    /** @param list<mixed>|null $images */
    public function __construct(
        public readonly ?int $variationId = null,
        public readonly ?bool $available = null,
        public readonly ?bool $isBase = null,
        public readonly ?string $key = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?string $customSku = null,
        public readonly ?string $title = null,
        public readonly ?string $summary = null,
        public readonly ?string $description = null,
        public readonly ?string $barcode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $hsCode = null,
        public readonly ?ProductVariantPricing $pricing = null,
        public readonly ?ProductVariantInventory $inventory = null,
        public readonly ?ProductVariantOrdering $ordering = null,
        public readonly ?ProductVariantDimensions $dimensions = null,
        public readonly ?ProductVariantBadges $badges = null,
        public readonly ?array $images = null,
    ) {
    }
}
