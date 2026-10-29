<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** The assign-customer body, bare: a generated `code` and the `email` of an existing customer. */
final class DiscountCouponCustomerInput extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $email = null,
    ) {
    }
}
