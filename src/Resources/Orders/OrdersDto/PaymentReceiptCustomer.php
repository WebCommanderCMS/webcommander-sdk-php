<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The customer a payment receipt names; `$id` is the public `customer_id`. */
final class PaymentReceiptCustomer extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $internalId = null,
        public readonly ?string $name = null,
    ) {
    }
}
