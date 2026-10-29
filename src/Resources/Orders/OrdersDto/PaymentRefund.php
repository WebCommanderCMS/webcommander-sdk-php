<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** What a payment refund answers. `$orderId` holds the order's internal id and `$orderNo` its
 *  order id. */
final class PaymentRefund extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $refundId = null,
        public readonly ?int $paymentId = null,
        public readonly ?int $orderId = null,
        public readonly ?int $orderNo = null,
        public readonly ?string $currency = null,
        public readonly ?float $amount = null,
        public readonly ?string $reason = null,
        public readonly ?bool $gatewayRefund = null,
        public readonly ?string $gatewayTransactionId = null,
        public readonly ?string $transactionStatus = null,
        public readonly ?string $paymentStatus = null,
        public readonly ?string $paymentRefundStatus = null,
        public readonly ?string $orderRefundStatus = null,
        public readonly ?float $orderRefundedTotal = null,
        public readonly ?float $orderAdjustment = null,
        public readonly ?float $orderTotal = null,
        public readonly ?float $availableForRefund = null,
        public readonly ?bool $adjustWithOrder = null,
        public readonly ?bool $refundEmailQueued = null,
        public readonly ?bool $inventoryReadjusted = null,
        public readonly ?string $refundedAt = null,
        public readonly ?bool $idempotentReplay = null,
    ) {
    }
}
