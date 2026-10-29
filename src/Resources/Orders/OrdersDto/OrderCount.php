<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The count sub-path's body, `{"orders": {"count": N}}`. */
final class OrderCount extends Dto
{
    public const ENVELOPE_KEY = 'orders';

    public function __construct(
        public readonly ?int $count = null,
    ) {
    }
}
