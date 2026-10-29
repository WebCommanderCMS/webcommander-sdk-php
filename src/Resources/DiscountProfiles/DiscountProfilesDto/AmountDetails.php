<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** The block an `amount` profile carries. */
final class AmountDetails extends Dto
{
    /** @param list<int>|null $tiers */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $applyTo = null,
        public readonly ?float $singleAmount = null,
        public readonly ?string $singleAmountType = null,
        public readonly ?string $minimumAmountOn = null,
        public readonly ?array $tiers = null,
    ) {
    }
}
