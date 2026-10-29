<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** The create-coupons answer: the codes generated, beside `status` and `message`. */
final class DiscountProfileCoupons extends Dto
{
    /** @param list<string>|null $codes */
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?string $message = null,
        public readonly ?array $codes = null,
    ) {
    }
}
