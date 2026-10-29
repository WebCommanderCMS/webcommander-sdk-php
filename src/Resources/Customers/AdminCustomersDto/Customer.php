<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One customer; a listing sends a subset of the fields and an omitted one reads null.
 *  `{customer_id}` paths take `$customerId`; the overlapping `$internalId` answers another customer. */
final class Customer extends Dto
{
    public const ENVELOPE_KEY = 'customer';

    /** @param list<Reference|null>|null $customerGroups
     *  @param list<Address|null>|null $addresses
     *  @param list<mixed>|null $newsletters
     *  @param list<CustomProperty|null>|null $customProperties */
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?int $internalId = null,
        /** A UUID string the store assigns; a create or update naming another one keeps the stored one. */
        public readonly ?string $uuid = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?string $status = null,
        public readonly ?string $gender = null,
        public readonly ?string $companyName = null,
        public readonly ?float $storeCredit = null,
        #[ListOf(Reference::class)]
        public readonly ?array $customerGroups = null,
        public readonly mixed $shippingProfile = null,
        #[ListOf(Address::class)]
        public readonly ?array $addresses = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $abn = null,
        public readonly ?string $abnBranch = null,
        public readonly ?bool $accountHold = null,
        public readonly ?int $activeBillingAddress = null,
        public readonly ?int $activeShippingAddress = null,
        public readonly ?bool $allowCreditLimit = null,
        public readonly ?string $backgroundImage = null,
        public readonly ?string $baseUrl = null,
        public readonly ?int $countReferralCodeUsed = null,
        public readonly ?float $creditLimit = null,
        #[ListOf(CustomProperty::class)]
        public readonly ?array $customProperties = null,
        public readonly ?bool $customerPasswordExpired = null,
        public readonly ?string $defaultTaxCode = null,
        public readonly ?bool $emailVerified = null,
        public readonly ?bool $hidePrice = null,
        public readonly ?string $howDoYouKnow = null,
        public readonly ?bool $isInTrash = null,
        public readonly ?array $newsletters = null,
        public readonly ?string $note = null,
        public readonly mixed $paymentTerm = null,
        public readonly mixed $profilePicture = null,
        public readonly mixed $referralCode = null,
        public readonly ?bool $smsSubscribed = null,
        public readonly ?string $source = null,
        public readonly ?string $timezone = null,
        public readonly ?string $transactionNumber = null,
        public readonly mixed $usedReferralCode = null,
        public readonly ?int $version = null,
    ) {
    }
}
