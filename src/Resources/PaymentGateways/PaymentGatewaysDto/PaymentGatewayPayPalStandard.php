<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** PayPal's `standard` credentials. */
final class PaymentGatewayPayPalStandard extends Dto
{
    public function __construct(
        public readonly ?string $clientId = null,
        public readonly ?string $clientSecret = null,
    ) {
    }
}
