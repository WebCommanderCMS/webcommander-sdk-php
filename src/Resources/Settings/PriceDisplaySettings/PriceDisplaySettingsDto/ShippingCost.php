<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `shipping_cost` block: where the shipping line shows, and whether it carries tax and discount. */
final class ShippingCost extends Dto
{
    public function __construct(
        public readonly ?DisplayScopes $show = null,
        public readonly ?ScopedToggle $includeTax = null,
        public readonly ?ScopedToggle $includeDiscount = null,
    ) {
    }
}
