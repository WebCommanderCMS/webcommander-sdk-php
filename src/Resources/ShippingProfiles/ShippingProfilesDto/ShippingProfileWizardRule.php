<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;

/** A rule the wizard creates beside its rate: `name` is required, `$shippingClass` is a class id, and `$zones` name existing zones by `{"id": ...}` or new ones by `{"name": ...}`. */
final class ShippingProfileWizardRule extends Dto
{
    /** @param list<ShippingReference>|null $zones */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?int $shippingClass = null,
        public readonly ?ShippingProfileWizardRate $shippingRate = null,
        public readonly ?array $zones = null,
    ) {
    }
}
