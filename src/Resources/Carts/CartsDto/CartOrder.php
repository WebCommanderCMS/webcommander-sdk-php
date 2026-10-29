<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The order a cart became, with the write's `status` read from beside the envelope. */
final class CartOrder extends Dto
{
    public const ENVELOPE_KEY = 'order';

    /** @param list<CartOrderLine|null>|null $orderLineDetails
     *  @param list<CartOrderPayment|null>|null $payments
     *  @param list<mixed>|null $customFields */
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $orderId = null,
        public readonly ?int $internalId = null,
        public readonly ?int $orderNo = null,
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
        public readonly ?CartOrderCustomer $customerSummary = null,
        #[ListOf(CartOrderLine::class)]
        public readonly ?array $orderLineDetails = null,
        #[ListOf(CartOrderPayment::class)]
        public readonly ?array $payments = null,
        public readonly mixed $externalReferenceOrderId = null,
        public readonly mixed $externalReferenceStoreId = null,
        public readonly mixed $externalReferenceOrderNo = null,
        public readonly mixed $externalReferenceStatus = null,
        public readonly mixed $externalReferenceUrl = null,
        public readonly ?string $customerPoNumber = null,
        public readonly ?string $paymentTerm = null,
        public readonly ?string $fulfillmentMode = null,
        public readonly ?string $fulfillmentTerm = null,
        public readonly ?string $invoiceMode = null,
        public readonly ?CartOrderAddress $billingAddress = null,
        public readonly ?CartOrderAddress $shippingAddress = null,
        public readonly ?array $customFields = null,
    ) {
    }
}
