<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;

/** The wizard's body, wrapped in `shipping_profile`: the profile fields and the rules, each with its rate, to create under it. */
final class ShippingProfileWizardInput extends Dto
{
    public const ENVELOPE_KEY = 'shipping_profile';

    /** @param list<ShippingProfileWizardRule>|null $shippingRules */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $rulePreference = null,
        public readonly ?array $shippingRules = null,
    ) {
    }
}
