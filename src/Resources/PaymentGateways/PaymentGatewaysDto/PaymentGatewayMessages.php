<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The pending and completed messages; a message the gateway's form lacks reads null. */
final class PaymentGatewayMessages extends Dto
{
    public function __construct(
        public readonly ?string $pending = null,
        public readonly ?string $completed = null,
    ) {
    }
}
