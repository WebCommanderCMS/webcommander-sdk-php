<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One shipment. A write sends `method`, `tracking_info` and `shipping_date`, read back as
 *  `shipping_method`, `tracking_number` and `date_created`; `status` sits beside. */
final class OrderShipment extends Dto
{
    public const ENVELOPE_KEY = 'shipment';

    /** @param list<ShipmentItem|null>|null $items */
    public function __construct(
        public readonly ?int $shippingId = null,
        public readonly ?int $orderId = null,
        public readonly ?int $orderInternalId = null,
        public readonly ?int $customerId = null,
        public readonly ?int $customerInternalId = null,
        public readonly ?int $orderAddressId = null,
        public readonly ?string $dateCreated = null,
        public readonly ?string $trackingNumber = null,
        public readonly ?string $shippingMethod = null,
        public readonly ?OrderAddress $shippingAddress = null,
        public readonly ?OrderAddress $billingAddress = null,
        #[ListOf(ShipmentItem::class)]
        public readonly ?array $items = null,
        public readonly ?string $status = null,
    ) {
    }
}
