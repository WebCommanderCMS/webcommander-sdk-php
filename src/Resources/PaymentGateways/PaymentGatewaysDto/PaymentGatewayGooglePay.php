<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** Express Checkout's Google Pay block. */
final class PaymentGatewayGooglePay extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $paymentMode = null,
        public readonly ?string $merchantName = null,
        public readonly ?string $merchantId = null,
        public readonly ?string $processor = null,
        public readonly ?string $secretKey = null,
        public readonly ?string $publicKey = null,
        public readonly ?float $freeShippingConditionAmount = null,
        public readonly ?float $shippingCost = null,
    ) {
    }
}
