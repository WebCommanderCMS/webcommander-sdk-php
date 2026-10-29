<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One group. A listing row and a create, patch or assign answer carry the thirteen fields up to
 *  `$updatedAt`; the row read and the membership write add the next two. */
final class CustomerGroup extends Dto
{
    public const ENVELOPE_KEY = 'customer_group';

    /** @param list<CustomerGroupMember|null>|null $customers */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $status = null,
        public readonly ?string $defaultTaxCode = null,
        public readonly ?bool $addAsNewCustomerDefaultGroup = null,
        public readonly ?CustomerGroupShippingProfile $shippingProfile = null,
        public readonly ?CustomerGroupBackgroundImage $backgroundImage = null,
        public readonly ?CustomerGroupPurchasePreference $purchasePreference = null,
        public readonly ?CustomerGroupTaxConfiguration $taxConfiguration = null,
        public readonly ?CustomerGroupProductDisplay $productDisplay = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $customerCount = null,
        #[ListOf(CustomerGroupMember::class)]
        public readonly ?array $customers = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
