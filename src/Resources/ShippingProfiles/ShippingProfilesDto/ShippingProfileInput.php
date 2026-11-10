<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;

/** The writable fields, wrapped in `shipping_profile`, for the create, the `PUT` replace and the `PATCH`. `$shippingRules` is the whole list of rule ids, each rule once; `PUT` needs `name`, `description`, `rulePreference` and `shippingRules`. `$default` takes only true or false. A null field is not sent: to clear one, pass an array. */
final class ShippingProfileInput extends Dto
{
    public const ENVELOPE_KEY = 'shipping_profile';

    /** @param list<int>|null $shippingRules */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $rulePreference = null,
        public readonly ?bool $default = null,
        public readonly ?array $shippingRules = null,
        public readonly ?string $transactionNo = null,
        public readonly ?bool $suggestName = null,
    ) {
    }
}
