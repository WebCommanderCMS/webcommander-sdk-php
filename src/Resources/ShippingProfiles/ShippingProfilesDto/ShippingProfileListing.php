<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, newest first. */
final class ShippingProfileListing extends Dto
{
    /** @param list<ShippingProfile|null>|null $shippingProfiles */
    public function __construct(
        #[ListOf(ShippingProfile::class)]
        public readonly ?array $shippingProfiles = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
