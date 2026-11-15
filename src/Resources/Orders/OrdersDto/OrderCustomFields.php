<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** An order's custom field values; a `delivery` order adds `delivery_cost`. */
final class OrderCustomFields extends Dto
{
    /** @param list<mixed>|null $customFields */
    public function __construct(
        public readonly ?int $orderId = null,
        public readonly ?int $internalId = null,
        public readonly ?array $customFields = null,
        public readonly ?float $deliveryCost = null,
    ) {
    }
}
