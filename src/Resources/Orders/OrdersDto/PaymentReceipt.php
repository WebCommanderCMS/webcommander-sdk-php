<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** What recording a payment answers; `$id` is the `payment_id` a payment refund takes. */
final class PaymentReceipt extends Dto
{
    public const ENVELOPE_KEY = 'payment';

    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $id = null,
        public readonly ?string $date = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $transactionReference = null,
        public readonly ?float $paymentApplied = null,
        public readonly ?string $paymentMethod = null,
        public readonly ?string $payerInfo = null,
        public readonly ?int $orderId = null,
        public readonly ?int $orderInternalId = null,
        public readonly ?float $orderTotal = null,
        public readonly ?float $dueAmount = null,
        public readonly ?float $paidAmount = null,
        public readonly ?PaymentReceiptCustomer $customer = null,
        public readonly ?string $createdBy = null,
        public readonly ?string $createdAt = null,
    ) {
    }
}
