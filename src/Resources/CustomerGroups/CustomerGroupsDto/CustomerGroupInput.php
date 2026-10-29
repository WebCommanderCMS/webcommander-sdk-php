<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** The writable form of `CustomerGroup`, for the create and the patch. `$status` takes `A`, `I`,
 *  `active` or `inactive`; `$shippingProfile` is a bare id. */
final class CustomerGroupInput extends Dto
{
    public const ENVELOPE_KEY = 'customer_group';

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $status = null,
        public readonly ?string $defaultTaxCode = null,
        public readonly ?bool $addAsNewCustomerDefaultGroup = null,
        public readonly ?int $shippingProfile = null,
        public readonly ?string $backgroundImage = null,
        public readonly ?CustomerGroupPurchasePreference $purchasePreference = null,
        public readonly ?CustomerGroupTaxConfiguration $taxConfiguration = null,
        public readonly ?CustomerGroupProductDisplay $productDisplay = null,
    ) {
    }
}
