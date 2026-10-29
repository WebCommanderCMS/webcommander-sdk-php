<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The `PATCH` body: the seven fields it writes; an address sent replaces that address. */
final class OrderPatchInput extends Dto
{
    public const ENVELOPE_KEY = 'order';

    public function __construct(
        public readonly ?string $orderStatus = null,
        public readonly ?string $customerPoNumber = null,
        public readonly ?string $paymentTerm = null,
        public readonly ?OrderAddressInput $billingAddress = null,
        public readonly ?OrderAddressInput $shippingAddress = null,
        public readonly ?string $orderChannel = null,
        public readonly ?string $ipAddress = null,
    ) {
    }
}
