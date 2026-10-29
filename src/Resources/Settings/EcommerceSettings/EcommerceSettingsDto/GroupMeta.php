<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per key, `order_flags` included. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $continueShopping = null,
        public readonly ?SectionMeta $productInventory = null,
        public readonly ?SectionMeta $pricing = null,
        public readonly ?SectionMeta $productRestriction = null,
        public readonly ?SectionMeta $orderFilters = null,
        public readonly ?SectionMeta $locationSettings = null,
        public readonly ?SectionMeta $orderFlags = null,
    ) {
    }
}
