<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One written variant: `id` and `name`, and the rest with `response=full`, where the
 *  pricing, inventory and ordering records carry a subset of their fields. */
final class ProductVariantUpdate extends Dto
{
    /** @param list<ProductVariantOptionReference|null>|null $options */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?string $customSku = null,
        public readonly ?string $barcode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $hsCode = null,
        public readonly ?bool $available = null,
        #[ListOf(ProductVariantOptionReference::class)]
        public readonly ?array $options = null,
        public readonly ?ProductVariantPricing $pricing = null,
        public readonly ?ProductVariantInventory $inventory = null,
        public readonly ?ProductVariantOrdering $ordering = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $url = null,
    ) {
    }
}
