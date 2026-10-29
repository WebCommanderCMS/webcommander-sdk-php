<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** The `order_filters` section: the status each admin order list opens on, null when unset. */
final class OrderFilters extends Dto
{
    public const ENVELOPE_KEY = 'order_filters';

    public function __construct(
        public readonly ?string $defaultOrderStatus = null,
        public readonly ?string $defaultPaymentStatus = null,
        public readonly ?string $defaultShipmentStatus = null,
    ) {
    }
}
