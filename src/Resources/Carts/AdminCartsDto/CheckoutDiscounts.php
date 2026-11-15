<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** At most one coupon and one gift card; null for one not applied. */
final class CheckoutDiscounts extends Dto
{
    public function __construct(
        public readonly ?CheckoutCoupon $coupon = null,
        public readonly ?CheckoutGiftCard $giftCard = null,
    ) {
    }
}
