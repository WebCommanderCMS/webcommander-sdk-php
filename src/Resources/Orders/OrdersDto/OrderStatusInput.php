<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The status body; `status` is required: `cancelled`, `completed`, `draft`, `in_progress`,
 *  `paused` or `reopened`. */
final class OrderStatusInput extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?string $transactionNo = null,
        public readonly ?bool $refundAutomatically = null,
    ) {
    }
}
