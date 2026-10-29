<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** The block a `shipping` profile carries. */
final class ShippingDetails extends Dto
{
    /** @param list<mixed>|null $tiers */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $applyTo = null,
        public readonly ?string $minimumQtyOn = null,
        public readonly ?string $amountType = null,
        public readonly ?string $singleAmountType = null,
        public readonly ?int $minimumQty = null,
        public readonly ?float $minimumAmount = null,
        public readonly mixed $singleAmount = null,
        public readonly mixed $capAmount = null,
        public readonly mixed $maximumTime = null,
        public readonly mixed $zone = null,
        public readonly mixed $shippingClass = null,
        public readonly ?array $tiers = null,
    ) {
    }
}
