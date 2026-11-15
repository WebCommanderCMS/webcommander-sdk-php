<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The delivery the checkout was priced for; empty until a `$deliveryType` is set. */
final class CheckoutShipping extends Dto
{
    public function __construct(
        public readonly ?string $deliveryType = null,
        public readonly ?string $shippingType = null,
        public readonly ?float $shippingCost = null,
        public readonly ?float $shippingTax = null,
    ) {
    }
}
