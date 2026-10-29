<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** A one-key `{"enabled": ...}` switch. */
final class PaymentGatewayToggle extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
    ) {
    }
}
