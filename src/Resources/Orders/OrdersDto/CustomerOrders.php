<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One customer's orders, unpaged, cancelled ones left out. */
final class CustomerOrders extends Dto
{
    /** @param list<FlatOrder|null>|null $orders */
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?int $internalId = null,
        #[ListOf(FlatOrder::class)]
        public readonly ?array $orders = null,
    ) {
    }
}
