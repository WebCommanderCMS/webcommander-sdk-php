<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The coupon applied: `$appliedAmount` is the discount it takes off. */
final class CheckoutCoupon extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $status = null,
        public readonly ?float $appliedAmount = null,
    ) {
    }
}
