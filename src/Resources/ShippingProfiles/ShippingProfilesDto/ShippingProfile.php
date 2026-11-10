<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One profile, the same ten keys on a listing row, the row read and every write's answer. `$rulePreference` reads `product_assigned_rule`, `lowest_shipping_cost_rule` or `highest_shipping_cost_rule`; exactly one profile has `$default` true. */
final class ShippingProfile extends Dto
{
    public const ENVELOPE_KEY = 'shipping_profile';

    /** @param list<ShippingProfileRule|null>|null $shippingRules */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $rulePreference = null,
        public readonly ?bool $default = null,
        public readonly ?int $rulesCount = null,
        #[ListOf(ShippingProfileRule::class)]
        public readonly ?array $shippingRules = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
