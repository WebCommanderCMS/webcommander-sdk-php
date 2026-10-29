<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `my_orders` block - what the orders tab shows and which order lists it offers. */
final class MyOrders extends Dto
{
    /** @param list<ProfileEntry|null>|null $sections */
    public function __construct(
        public readonly ?MyOrderFlags $flags = null,
        #[ListOf(ProfileEntry::class)]
        public readonly ?array $sections = null,
    ) {
    }
}
