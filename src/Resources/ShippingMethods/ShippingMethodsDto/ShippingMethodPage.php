<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingMethods\ShippingMethodsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, with the `field_metadata` block when it was asked for. */
final class ShippingMethodPage extends Dto
{
    /** @param list<ShippingMethod|null>|null $shippingMethods */
    public function __construct(
        #[ListOf(ShippingMethod::class)]
        public readonly ?array $shippingMethods = null,
        public readonly ?Pagination $pagination = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
