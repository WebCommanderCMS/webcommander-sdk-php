<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** A variant's order quantities; `$maxQuantity` 0 is no maximum. */
final class ProductVariantOrdering extends Dto
{
    public function __construct(
        public readonly ?int $minQuantity = null,
        public readonly ?int $maxQuantity = null,
        public readonly ?int $multipleOf = null,
        public readonly ?bool $isMultipleQuantityRequired = null,
    ) {
    }
}
