<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One refund an order holds. `order_id` is the order's internal id. A payment refund fills
 *  `record_only` to `lines`; an order refund leaves them `null` and `lines` empty.
 *  `gateway_charge_id`, `gateway_refund_id` and `failure_cause` were `null` on every refund read, so
 *  they are not typed. */
final class OrderRefundRecord extends Dto
{
    /** @param list<OrderRefundRecordLine|null>|null $lines */
    public function __construct(
        public readonly ?string $gateway = null,
        public readonly mixed $gatewayChargeId = null,
        public readonly mixed $gatewayRefundId = null,
        public readonly ?bool $recordOnly = null,
        public readonly ?string $initiatedBy = null,
        public readonly ?bool $cancelledWithOrder = null,
        public readonly ?bool $notifyCustomer = null,
        public readonly ?string $allocation = null,
        public readonly ?string $otherAmount = null,
        #[ListOf(OrderRefundRecordLine::class)]
        public readonly ?array $lines = null,
        public readonly ?int $refundId = null,
        public readonly ?int $paymentId = null,
        public readonly ?int $orderId = null,
        public readonly ?float $amount = null,
        public readonly ?string $status = null,
        public readonly ?string $transactionStatus = null,
        public readonly ?string $transactionId = null,
        public readonly ?string $reason = null,
        public readonly mixed $failureCause = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
