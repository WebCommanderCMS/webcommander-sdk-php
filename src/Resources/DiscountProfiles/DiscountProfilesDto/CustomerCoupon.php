<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** One generated coupon; `$customerEmail` is an empty string until a customer is assigned. */
final class CustomerCoupon extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $customerEmail = null,
    ) {
    }
}
