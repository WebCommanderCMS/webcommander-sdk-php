<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** A customer as the store accepts it - the writable form of Customer. */
final class CustomerInput extends Dto
{
    public const ENVELOPE_KEY = 'customer';
    public const TOP_LEVEL = ['transaction_no'];

    /** @param list<Address>|null $addresses */
    public function __construct(
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $email = null,
        public readonly ?bool $emailVerified = null,
        public readonly ?string $password = null,
        public readonly ?string $oldPassword = null,
        public readonly ?string $status = null,
        public readonly ?bool $company = null,
        public readonly ?string $companyName = null,
        public readonly ?string $addressLine1 = null,
        public readonly ?string $addressLine2 = null,
        public readonly ?string $city = null,
        public readonly int|string|null $state = null,
        public readonly int|string|null $country = null,
        public readonly ?string $postCode = null,
        #[ListOf(Address::class)]
        public readonly ?array $addresses = null,
        #[ListOf(CustomProperty::class)]
        public readonly ?array $customProperties = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
