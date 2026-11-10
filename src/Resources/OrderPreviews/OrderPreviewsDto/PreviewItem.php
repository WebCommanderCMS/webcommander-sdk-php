<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** One line of the preview, priced by the store. */
final class PreviewItem extends Dto
{
    public function __construct(
        public readonly ?int $productId = null,
        public readonly ?string $productName = null,
        public readonly ?string $sku = null,
        public readonly ?int $quantity = null,
        public readonly ?float $price = null,
        public readonly ?float $discount = null,
        public readonly ?float $tax = null,
        public readonly ?float $totalAmount = null,
        public readonly ?bool $taxable = null,
        public readonly ?bool $shippable = null,
    ) {
    }
}
