<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use WebCommander\Client\Dto;

/** One entry of a customer's `addresses`. */
final class Address extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $type = null,
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
