<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;
use WebCommander\Resources\Orders\OrdersDto\OrderAddressInput;

/** The checkout update body. `$deliveryType` is `shipping`, `delivery`, `others_shipping` or `store_pickup`; an address replaces the whole one. */
final class AdminCheckoutInput extends Dto
{
    public function __construct(
        public readonly ?string $deliveryType = null,
        public readonly ?OrderAddressInput $billingAddress = null,
        public readonly ?OrderAddressInput $shippingAddress = null,
    ) {
    }
}
