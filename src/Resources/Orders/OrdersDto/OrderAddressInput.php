<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** An address to write, replacing the stored one. */
final class OrderAddressInput extends Dto
{
    public function __construct(
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $email = null,
        public readonly ?string $companyName = null,
        public readonly ?string $addressLine1 = null,
        public readonly ?string $addressLine2 = null,
        public readonly ?string $city = null,
        public readonly ?string $postCode = null,
        public readonly ?string $phone = null,
        public readonly ?string $mobile = null,
        public readonly ?string $fax = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $stateCode = null,
    ) {
    }
}
