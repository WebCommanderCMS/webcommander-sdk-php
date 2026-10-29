<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The `group_meta` block; the listing's has no entry for the two addresses. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $customer = null,
        public readonly ?SectionMeta $billingAddress = null,
        public readonly ?SectionMeta $shippingAddress = null,
        public readonly ?SectionMeta $items = null,
        public readonly ?SectionMeta $shipping = null,
        public readonly ?SectionMeta $discounts = null,
        public readonly ?SectionMeta $chargesTotals = null,
        public readonly ?SectionMeta $payments = null,
        public readonly ?SectionMeta $fulfillment = null,
    ) {
    }
}
