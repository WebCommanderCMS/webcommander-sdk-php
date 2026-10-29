<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** The bulk write's body, no envelope: the variant ids and at least one of the six fields. */
final class ProductVariationsBulkInput extends Dto
{
    /** @param list<int|string>|null $variationIds */
    public function __construct(
        public readonly ?array $variationIds = null,
        public readonly ?bool $available = null,
        public readonly ?float $basePrice = null,
        public readonly ?float $costPrice = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $minOrderQuantity = null,
        public readonly ?int $maxOrderQuantity = null,
    ) {
    }
}
