<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The order write's body, no envelope; `$customerId` takes the customer's `customer_id`. */
final class CartOrderInput extends Dto
{
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?string $paymentGateway = null,
        public readonly ?string $deliveryType = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
