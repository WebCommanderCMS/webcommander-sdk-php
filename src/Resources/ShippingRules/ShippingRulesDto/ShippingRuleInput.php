<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRules\ShippingRulesDto;

use WebCommander\Client\Dto;

/** The writable fields, wrapped in `shipping_rule`, for the create, the `PUT` replace and the `PATCH`. `$zones` is the whole list of zones, each once; `$profileId` adds the new rule to a profile on a create. `PUT` needs `name`, `description`, `shippingClass`, `shippingRate` and `zones`. A null field is not sent: to clear a class or a rate, pass an array holding null. */
final class ShippingRuleInput extends Dto
{
    public const ENVELOPE_KEY = 'shipping_rule';

    /** @param list<int|ShippingReference>|null $zones */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly int|ShippingReference|null $shippingClass = null,
        public readonly int|ShippingReference|null $shippingRate = null,
        public readonly ?array $zones = null,
        public readonly ?int $profileId = null,
        public readonly ?string $transactionNo = null,
        public readonly ?bool $suggestName = null,
    ) {
    }
}
