<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The create-with-payment body. */
final class OrderWithPaymentInput extends Dto
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
        public readonly ?InitialPaymentInput $payment = null,
    ) {
    }
}
