<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** A variant's two badges. */
final class ProductVariantBadges extends Dto
{
    public function __construct(
        public readonly ?bool $isFeatured = null,
        public readonly ?bool $isNewArrival = null,
    ) {
    }
}
