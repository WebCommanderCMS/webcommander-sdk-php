<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The read-only `profile_page` section, every tab of the customer's own page. */
final class ProfilePage extends Dto
{
    public const ENVELOPE_KEY = 'profile_page';

    /** @param list<ProfileEntry|null>|null $tabs
     *  @param list<ProfileOverviewEntry|null>|null $overview
     *  @param list<ProfileEntry|null>|null $myEntitlements */
    public function __construct(
        public readonly ?string $pageHtml = null,
        #[ListOf(ProfileEntry::class)]
        public readonly ?array $tabs = null,
        #[ListOf(ProfileOverviewEntry::class)]
        public readonly ?array $overview = null,
        public readonly ?ManageMyAccount $manageMyAccount = null,
        public readonly ?MyOrders $myOrders = null,
        #[ListOf(ProfileEntry::class)]
        public readonly ?array $myEntitlements = null,
        public readonly ?AssignToCustomer $assignToCustomer = null,
    ) {
    }
}
