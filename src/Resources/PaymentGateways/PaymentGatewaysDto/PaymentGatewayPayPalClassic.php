<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** PayPal's `classic` account. */
final class PaymentGatewayPayPalClassic extends Dto
{
    public function __construct(
        public readonly ?string $emailAddress = null,
    ) {
    }
}
