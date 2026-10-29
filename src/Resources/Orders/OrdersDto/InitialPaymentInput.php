<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The payment a create-with-payment records. */
final class InitialPaymentInput extends Dto
{
    public function __construct(
        public readonly ?float $amount = null,
        public readonly ?float $surcharge = null,
        public readonly ?string $status = null,
        public readonly ?string $paymentMethod = null,
        public readonly ?string $trackInfo = null,
        public readonly ?string $payerInfo = null,
        public readonly ?string $transactionReference = null,
        public readonly ?string $transactionDate = null,
    ) {
    }
}
