<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The cancel body; every field is optional and an empty request cancels too. */
final class OrderCancelInput extends Dto
{
    public function __construct(
        public readonly ?string $transactionNo = null,
        public readonly ?string $reason = null,
        public readonly ?bool $refundAutomatically = null,
        public readonly ?bool $isGatewayRefund = null,
    ) {
    }
}
