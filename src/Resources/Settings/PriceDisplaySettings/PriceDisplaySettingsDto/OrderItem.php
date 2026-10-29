<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `order_item` section: how a line item's own price is shown, in five `ScopedToggle` blocks. */
final class OrderItem extends Dto
{
    public const ENVELOPE_KEY = 'order_item';

    public function __construct(
        public readonly ?ScopedToggle $priceIncludingTax = null,
        public readonly ?ScopedToggle $priceIncludingDiscount = null,
        public readonly ?ScopedToggle $taxInLine = null,
        public readonly ?ScopedToggle $discountInLineItem = null,
        public readonly ?ScopedToggle $itemTotalIncludingTax = null,
    ) {
    }
}
