<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The custom status body; `order_id` is required. */
final class CustomOrderStatusInput extends Dto
{
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?string $orderStatusValue = null,
        public readonly ?string $orderStatusLabel = null,
        public readonly ?string $orderType = null,
        public readonly ?string $statusType = null,
    ) {
    }
}
