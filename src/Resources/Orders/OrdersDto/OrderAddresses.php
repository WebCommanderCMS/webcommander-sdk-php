<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** What the addresses sub-path answers: both addresses as they now stand. */
final class OrderAddresses extends Dto
{
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?int $internalId = null,
        public readonly ?OrderAddress $billingAddress = null,
        public readonly ?OrderAddress $shippingAddress = null,
    ) {
    }
}
