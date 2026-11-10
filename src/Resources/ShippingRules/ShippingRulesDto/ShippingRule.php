<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRules\ShippingRulesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One rule, the same ten keys on a listing row, the row read and every write's answer. `$shippingClass` and `$shippingRate` are null when unset, `$zones` and `$profiles` empty lists. */
final class ShippingRule extends Dto
{
    public const ENVELOPE_KEY = 'shipping_rule';

    /** @param list<ShippingReference|null>|null $zones
     *  @param list<ShippingReference|null>|null $profiles */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?ShippingReference $shippingClass = null,
        public readonly ?ShippingReference $shippingRate = null,
        #[ListOf(ShippingReference::class)]
        public readonly ?array $zones = null,
        #[ListOf(ShippingReference::class)]
        public readonly ?array $profiles = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
