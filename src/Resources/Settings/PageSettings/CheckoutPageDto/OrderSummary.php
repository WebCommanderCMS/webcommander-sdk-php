<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `order_summary` section: what the checkout's summary panel shows. */
final class OrderSummary extends Dto
{
    public const ENVELOPE_KEY = 'order_summary';

    public function __construct(
        public readonly ?bool $showProductThumbnail = null,
        public readonly ?bool $showQuantity = null,
        public readonly ?bool $enablePaymentExpandView = null,
        public readonly ?bool $orderConfirmCaptcha = null,
    ) {
    }
}
