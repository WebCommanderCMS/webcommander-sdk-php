<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$orderFlags` is a list, and no section route answers for it. */
final class EcommerceSettings extends Dto
{
    public const ENVELOPE_KEY = 'ecommerce_settings';

    /** @param list<OrderFlag|null>|null $orderFlags */
    public function __construct(
        public readonly ?ContinueShopping $continueShopping = null,
        public readonly ?ProductInventory $productInventory = null,
        public readonly ?Pricing $pricing = null,
        public readonly ?ProductRestriction $productRestriction = null,
        public readonly ?OrderFilters $orderFilters = null,
        public readonly ?LocationSettings $locationSettings = null,
        #[ListOf(OrderFlag::class)]
        public readonly ?array $orderFlags = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
