<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The order's `customer` section, also sent as `customer_summary`. A listing row carries five of
 *  these keys; `$customerId` is the public id, `$internalId` the other. */
final class OrderCustomer extends Dto
{
    public function __construct(
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $customerGroup = null,
        public readonly ?string $gender = null,
        public readonly ?int $customerId = null,
        public readonly ?int $internalId = null,
        public readonly ?string $email = null,
        public readonly ?string $addressLine1 = null,
        public readonly ?string $addressLine2 = null,
        public readonly ?string $city = null,
        public readonly ?Reference $country = null,
        public readonly ?Reference $state = null,
        public readonly ?string $postCode = null,
        public readonly ?string $phone = null,
        public readonly ?string $mobile = null,
        public readonly ?string $fax = null,
        public readonly ?string $companyName = null,
    ) {
    }
}
