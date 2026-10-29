<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingClasses\ShippingClassesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, with the `field_metadata` block when it was asked for. */
final class ShippingClassPage extends Dto
{
    /** @param list<ShippingClass|null>|null $shippingClasses */
    public function __construct(
        #[ListOf(ShippingClass::class)]
        public readonly ?array $shippingClasses = null,
        public readonly ?Pagination $pagination = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
