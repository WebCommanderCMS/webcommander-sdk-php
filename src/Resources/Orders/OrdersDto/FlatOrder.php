<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One order with its totals and fulfilment at the top: what a create, a cancel and a status
 *  change answer, and a per-customer listing row. A create adds `status` beside the envelope. */
final class FlatOrder extends Dto
{
    public const ENVELOPE_KEY = 'order';

    /** @param list<OrderItem|null>|null $orderLineDetails
     *  @param list<OrderPayment|null>|null $payments
     *  @param list<mixed>|null $customFields */
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?int $orderNo = null,
        public readonly ?int $internalId = null,
        public readonly ?string $uuid = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $currencyCode = null,
        public readonly ?string $orderStatus = null,
        public readonly ?string $paymentStatus = null,
        public readonly ?string $shippingStatus = null,
        public readonly ?float $subTotal = null,
        public readonly ?float $shippingCost = null,
        public readonly ?float $shippingTax = null,
        public readonly ?float $handlingCost = null,
        public readonly ?float $totalSurcharge = null,
        public readonly ?float $totalDiscount = null,
        public readonly ?float $totalTax = null,
        public readonly ?float $grandTotal = null,
        public readonly ?float $paid = null,
        public readonly ?float $due = null,
        public readonly ?int $itemsTotal = null,
        public readonly ?string $ipAddress = null,
        public readonly ?string $orderChannel = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?OrderCustomer $customerSummary = null,
        #[ListOf(OrderItem::class)]
        public readonly ?array $orderLineDetails = null,
        #[ListOf(OrderPayment::class)]
        public readonly ?array $payments = null,
        public readonly ?string $externalReferenceOrderId = null,
        public readonly ?string $externalReferenceStoreId = null,
        public readonly ?string $externalReferenceOrderNo = null,
        public readonly ?string $externalReferenceStatus = null,
        public readonly ?string $externalReferenceUrl = null,
        public readonly ?string $customerPoNumber = null,
        public readonly ?string $paymentTerm = null,
        public readonly ?string $fulfillmentMode = null,
        public readonly ?string $fulfillmentTerm = null,
        public readonly ?string $invoiceMode = null,
        public readonly ?OrderAddress $billingAddress = null,
        public readonly ?OrderAddress $shippingAddress = null,
        public readonly ?array $customFields = null,
        public readonly ?string $status = null,
    ) {
    }
}
