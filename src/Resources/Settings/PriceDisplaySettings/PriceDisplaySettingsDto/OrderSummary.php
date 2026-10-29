<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `order_summary` section: which lines the summary panel shows, and what each includes. */
final class OrderSummary extends Dto
{
    public const ENVELOPE_KEY = 'order_summary';

    public function __construct(
        public readonly ?ScopedToggle $orderTotalExcludingTax = null,
        public readonly ?ScopedToggle $orderTotalIncludingDiscount = null,
        public readonly ?Subtotal $subtotal = null,
        public readonly ?Discount $discount = null,
        public readonly ?PlainToggle $subtotalTax = null,
        public readonly ?PlainToggle $totalTax = null,
        public readonly ?PlainToggle $orderTotal = null,
        public readonly ?ShippingCost $shippingCost = null,
        public readonly ?ShippingDiscount $shippingDiscount = null,
        public readonly ?Handling $handling = null,
        public readonly ?ScopedToggle $paymentSurcharge = null,
        public readonly ?PricingInfo $pricingInfo = null,
    ) {
    }
}
