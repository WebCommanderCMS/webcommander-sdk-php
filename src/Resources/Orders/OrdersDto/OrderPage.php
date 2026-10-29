<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, with the `field_metadata` block when it was asked for. */
final class OrderPage extends Dto
{
    /** @param list<Order|null>|null $orders */
    public function __construct(
        #[ListOf(Order::class)]
        public readonly ?array $orders = null,
        public readonly ?Pagination $pagination = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
