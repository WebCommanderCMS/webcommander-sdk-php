<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** A variant's stock; the bulk write's full answer carries the first three fields. */
final class ProductVariantInventory extends Dto
{
    public function __construct(
        public readonly ?bool $isEnabled = null,
        public readonly ?int $quantity = null,
        public readonly ?int $lowStockThreshold = null,
        public readonly ?bool $isSoldOut = null,
        public readonly ?string $soldOutLabel = null,
    ) {
    }
}
