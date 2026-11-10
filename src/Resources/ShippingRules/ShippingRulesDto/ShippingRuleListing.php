<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRules\ShippingRulesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, newest first. */
final class ShippingRuleListing extends Dto
{
    /** @param list<ShippingRule|null>|null $shippingRules */
    public function __construct(
        #[ListOf(ShippingRule::class)]
        public readonly ?array $shippingRules = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
