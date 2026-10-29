<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One line a shipment carries. */
final class ShipmentItem extends Dto
{
    public function __construct(
        public readonly ?int $orderItemId = null,
        public readonly ?int $productId = null,
        public readonly ?string $productName = null,
        public readonly ?string $productSku = null,
        public readonly ?string $shippingClass = null,
        public readonly ?int $orderQuantity = null,
        public readonly ?int $shippedQuantity = null,
        public readonly ?float $totalAmount = null,
    ) {
    }
}
