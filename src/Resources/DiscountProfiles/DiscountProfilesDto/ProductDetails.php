<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** The block a `product` profile carries. */
final class ProductDetails extends Dto
{
    /** @param list<mixed>|null $productIds
     *  @param list<mixed>|null $categoryIds
     *  @param list<mixed>|null $tiers */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $freeProductMinQtyOn = null,
        public readonly ?int $freeProductMaxQty = null,
        public readonly ?float $freeProductMinAmount = null,
        public readonly ?string $minimumQtyOn = null,
        public readonly ?string $amountType = null,
        public readonly ?string $singleAmountType = null,
        public readonly mixed $singleAmount = null,
        public readonly mixed $capPrice = null,
        public readonly mixed $capPriceMaxQty = null,
        public readonly ?array $productIds = null,
        public readonly ?array $categoryIds = null,
        public readonly ?array $tiers = null,
    ) {
    }
}
