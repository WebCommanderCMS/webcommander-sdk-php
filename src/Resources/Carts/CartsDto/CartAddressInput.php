<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** A `shipping_address` or `billing_address`; the cart answers neither back. The two address lines
 *  are `address_line1` and `address_line2`, where an order's are `address_line_1` and `address_line_2`. */
final class CartAddressInput extends Dto
{
    public function __construct(
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        #[WireName('address_line1')]
        public readonly ?string $addressLine1 = null,
        #[WireName('address_line2')]
        public readonly ?string $addressLine2 = null,
        public readonly ?string $city = null,
        public readonly ?string $postCode = null,
        public readonly ?string $phone = null,
        public readonly ?string $mobile = null,
        public readonly ?string $fax = null,
        public readonly ?string $email = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $stateCode = null,
    ) {
    }
}
