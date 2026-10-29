<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The `PUT` body; it writes the customer and the two addresses, and nothing else. */
final class OrderUpdateInput extends Dto
{
    public const ENVELOPE_KEY = 'order';

    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?OrderAddressInput $billingAddress = null,
        public readonly ?OrderAddressInput $shippingAddress = null,
    ) {
    }
}
