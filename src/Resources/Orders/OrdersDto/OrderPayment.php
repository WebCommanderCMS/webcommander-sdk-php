<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One entry of an order's `payments`; `$gatewayResponse` comes only in the flat shape. */
final class OrderPayment extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $status = null,
        public readonly ?float $amount = null,
        public readonly ?string $paymentMethod = null,
        public readonly ?string $trackInfo = null,
        public readonly ?string $gatewayName = null,
        public readonly ?string $gatewayCode = null,
        public readonly ?string $gatewayResponse = null,
        public readonly ?string $payerInfo = null,
        public readonly ?string $payingDate = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $transactionReference = null,
    ) {
    }
}
