<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** Express Checkout's PayPal block. */
final class PaymentGatewayExpressPayPal extends Dto
{
    public function __construct(
        public readonly ?bool $showInstallmentAmount = null,
    ) {
    }
}
