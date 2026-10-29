<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The delivery types the gateway is offered for; null on gateways without the choice. */
final class PaymentGatewayAllowedFor extends Dto
{
    public function __construct(
        public readonly ?bool $shipping = null,
        public readonly ?bool $delivery = null,
        public readonly ?bool $storePickup = null,
    ) {
    }
}
