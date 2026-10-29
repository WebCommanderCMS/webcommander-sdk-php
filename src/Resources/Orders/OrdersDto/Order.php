<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One order in sections: the row path's body, a `PUT` or `PATCH` answer, and a listing row,
 *  which carries no `billing_address` or `shipping_address`. */
final class Order extends Dto
{
    public const ENVELOPE_KEY = 'order';

    /** @param list<OrderItem|null>|null $items
     *  @param list<OrderPayment|null>|null $payments */
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?int $orderNo = null,
        public readonly ?int $internalId = null,
        /** A UUID string the store assigns; not writable. */
        public readonly ?string $uuid = null,
        public readonly ?string $orderStatus = null,
        public readonly ?string $paymentStatus = null,
        public readonly ?string $shippingStatus = null,
        public readonly ?string $currencyCode = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $ipAddress = null,
        public readonly ?string $orderChannel = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly ?OrderCustomer $customer = null,
        public readonly ?OrderAddress $billingAddress = null,
        public readonly ?OrderAddress $shippingAddress = null,
        #[ListOf(OrderItem::class)]
        public readonly ?array $items = null,
        public readonly ?OrderShipping $shipping = null,
        public readonly ?OrderDiscounts $discounts = null,
        public readonly ?OrderChargesTotals $chargesTotals = null,
        #[ListOf(OrderPayment::class)]
        public readonly ?array $payments = null,
        public readonly ?OrderFulfillment $fulfillment = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
