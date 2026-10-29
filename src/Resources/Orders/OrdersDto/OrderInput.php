<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The create body, with no envelope. `payment_gateway` takes a code, `PIS` for pay in store,
 *  and `delivery_type` is lower case; `PAY_IN_STORE` and `SHIPPING` are `400`. */
final class OrderInput extends Dto
{
    /** @param list<OrderProductInput|null>|null $products */
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?string $paymentGateway = null,
        public readonly ?string $deliveryType = null,
        public readonly ?bool $isSendEmail = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $externalReferenceOrderId = null,
        public readonly ?OrderAddressInput $billingAddress = null,
        public readonly ?OrderAddressInput $shippingAddress = null,
        #[ListOf(OrderProductInput::class)]
        public readonly ?array $products = null,
        public readonly ?string $orderChannel = null,
        public readonly ?string $ipAddress = null,
    ) {
    }
}
