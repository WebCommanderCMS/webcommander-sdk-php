<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `delivery_options` section, four booleans; turning all four off is `400`. */
final class DeliveryOptions extends Dto
{
    public const ENVELOPE_KEY = 'delivery_options';

    public function __construct(
        public readonly ?bool $enableShipping = null,
        public readonly ?bool $enableStorePickup = null,
        public readonly ?bool $enableShippingQuote = null,
        public readonly ?bool $enableDeliveryService = null,
    ) {
    }
}
