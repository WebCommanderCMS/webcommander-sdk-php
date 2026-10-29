<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The shipment body; a create needs `method`, `shipping_date` and `shipment_items`. An update
 *  changes only what it names, and new `shipment_items` need `change_note`. */
final class OrderShipmentInput extends Dto
{
    /** @param list<ShipmentItemInput|null>|null $shipmentItems */
    public function __construct(
        public readonly ?string $transactionNo = null,
        public readonly ?string $method = null,
        public readonly ?string $trackingInfo = null,
        public readonly ?string $shippingDate = null,
        #[ListOf(ShipmentItemInput::class)]
        public readonly ?array $shipmentItems = null,
        public readonly ?string $changeNote = null,
    ) {
    }
}
