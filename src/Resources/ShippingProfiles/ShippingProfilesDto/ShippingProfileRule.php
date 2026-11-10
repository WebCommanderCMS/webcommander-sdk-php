<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;

/** A rule on a profile; `$shippingRate` is null on a rule that has no rate. */
final class ShippingProfileRule extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?ShippingReference $shippingRate = null,
    ) {
    }
}
