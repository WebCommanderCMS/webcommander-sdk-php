<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The payment refund body: `{"refund": {...}}` with `transaction_no` beside it. */
final class PaymentRefundInput extends Dto
{
    public const ENVELOPE_KEY = 'refund';

    public const TOP_LEVEL = ['transaction_no'];

    public function __construct(
        public readonly ?string $amount = null,
        public readonly ?string $reason = null,
        public readonly ?bool $isGatewayRefund = null,
        public readonly ?bool $sendRefundEmail = null,
        public readonly ?bool $adjustWithOrder = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
