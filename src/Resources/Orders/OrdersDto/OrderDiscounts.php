<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The `discounts` section. */
final class OrderDiscounts extends Dto
{
    public function __construct(
        public readonly ?float $totalDiscount = null,
        public readonly ?string $couponCode = null,
        public readonly ?string $giftCardCode = null,
    ) {
    }
}
