<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $billingAddress = null,
        public readonly ?SectionMeta $shippingAddress = null,
        public readonly ?SectionMeta $customerCheckout = null,
        public readonly ?SectionMeta $deliveryOptions = null,
        public readonly ?SectionMeta $orderSummary = null,
        public readonly ?SectionMeta $others = null,
    ) {
    }
}
