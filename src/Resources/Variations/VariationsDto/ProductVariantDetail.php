<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One variant read alone, under `variation`. It is on or off as `$active`, where the list and the
 *  bulk write say `available`; `$options` name one label per type. */
final class ProductVariantDetail extends Dto
{
    public const ENVELOPE_KEY = 'variation';

    /** @param list<ProductVariantOptionReference|null>|null $options */
    public function __construct(
        public readonly ?int $variationId = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?string $customSku = null,
        public readonly ?string $barcode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $hsCode = null,
        public readonly ?bool $active = null,
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
