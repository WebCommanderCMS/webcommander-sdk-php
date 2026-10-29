<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** The create-coupons body, bare; `$requestedCodes` is required and at least 1. */
final class DiscountProfileCouponsInput extends Dto
{
    public function __construct(
        public readonly ?int $requestedCodes = null,
    ) {
    }
}
