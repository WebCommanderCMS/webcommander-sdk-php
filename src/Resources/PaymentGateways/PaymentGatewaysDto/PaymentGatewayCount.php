<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The count sub-path's body, a bare `{"total": N}`. */
final class PaymentGatewayCount extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
    ) {
    }
}
