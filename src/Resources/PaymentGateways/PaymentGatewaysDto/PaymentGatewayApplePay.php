<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** Express Checkout's Apple Pay block. */
final class PaymentGatewayApplePay extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $paymentMode = null,
        public readonly ?string $merchantIdentifier = null,
        public readonly ?string $domainName = null,
        public readonly ?string $displayName = null,
        public readonly ?string $processor = null,
        public readonly ?string $secretKey = null,
        public readonly ?string $publicKey = null,
    ) {
    }
}
