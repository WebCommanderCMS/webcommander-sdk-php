<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The payment body: `{"payment": {...}}` with `transaction_no` beside the envelope. */
final class OrderPaymentInput extends Dto
{
    public const ENVELOPE_KEY = 'payment';

    public const TOP_LEVEL = ['transaction_no'];

    public function __construct(
        public readonly ?float $amount = null,
        public readonly ?string $paymentMethod = null,
        public readonly ?string $paymentStatus = null,
        public readonly ?string $trackInfo = null,
        public readonly ?string $payerInfo = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $transactionReference = null,
        public readonly ?float $surcharge = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
