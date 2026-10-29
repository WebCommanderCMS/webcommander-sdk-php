<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `shipping_discount` block: where the shipping discount line shows, its tax, and the shipping
 *  tax line's switch. */
final class ShippingDiscount extends Dto
{
    public function __construct(
        public readonly ?DisplayScopes $show = null,
        public readonly ?ScopedToggle $includeTax = null,
        public readonly ?PlainToggle $shippingTax = null,
    ) {
    }
}
