<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;
use WebCommander\Resources\Carts\CartsDto\Reference;

/** A billing or shipping address as the checkout reads it back; `$state` is `{}` when the address has none. */
final class CheckoutAddress extends Dto
{
    public function __construct(
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $email = null,
        public readonly ?string $companyName = null,
        public readonly ?string $addressLine1 = null,
        public readonly ?string $addressLine2 = null,
        public readonly ?Reference $country = null,
        public readonly ?Reference $state = null,
        public readonly ?string $city = null,
        public readonly ?string $postCode = null,
        public readonly ?string $mobile = null,
        public readonly ?string $phone = null,
        public readonly ?string $fax = null,
    ) {
    }
}
