<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `manage_my_account` block: the account screen's sections and the fields its three forms draw. */
final class ManageMyAccount extends Dto
{
    /** @param list<ProfileEntry|null>|null $sections
     *  @param list<ProfileField|null>|null $accountInformation
     *  @param list<ProfileField|null>|null $billingAddress
     *  @param list<ProfileField|null>|null $shippingAddress */
    public function __construct(
        #[ListOf(ProfileEntry::class)]
        public readonly ?array $sections = null,
        #[ListOf(ProfileField::class)]
        public readonly ?array $accountInformation = null,
        #[ListOf(ProfileField::class)]
        public readonly ?array $billingAddress = null,
        #[ListOf(ProfileField::class)]
        public readonly ?array $shippingAddress = null,
    ) {
    }
}
