<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** What an order refund answers; `$amount` is the text that was sent. */
final class OrderRefund extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $refundId = null,
        public readonly ?int $orderId = null,
        public readonly ?int $internalId = null,
        public readonly ?string $amount = null,
    ) {
    }
}
