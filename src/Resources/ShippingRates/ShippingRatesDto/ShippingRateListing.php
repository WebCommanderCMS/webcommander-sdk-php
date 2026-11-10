<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates\ShippingRatesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, newest first. */
final class ShippingRateListing extends Dto
{
    /** @param list<ShippingRate|null>|null $shippingRates */
    public function __construct(
        #[ListOf(ShippingRate::class)]
        public readonly ?array $shippingRates = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
