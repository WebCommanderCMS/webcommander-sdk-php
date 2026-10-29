<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The card gateway's processor; the client id and secret read `********` when set. */
final class PaymentGatewayCardProcessor extends Dto
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $mode = null,
        public readonly ?string $merchantCode = null,
        public readonly ?string $clientId = null,
        public readonly ?string $clientSecret = null,
        public readonly ?PaymentGatewayToggle $walletPayment = null,
    ) {
    }
}
