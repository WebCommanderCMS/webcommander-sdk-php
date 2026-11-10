<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;
use WebCommander\Resources\Orders\OrdersDto\OrderAddressInput;
use WebCommander\Resources\Orders\OrdersDto\OrderProductInput;

/** The start body, bare. `$products` is required. Without `$customerId` the billing address is required, and a shipping address too unless `$deliveryType` is `store_pickup`. `$deliveryType` is `shipping` unless it is `delivery`, `others_shipping` or `store_pickup`. An unknown field, such as `coupon_code` or a product line's `price`, is `400`. */
final class OrderPreviewInput extends Dto
{
    /** @param list<OrderProductInput|null>|null $products */
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?string $deliveryType = null,
        public readonly ?OrderAddressInput $billingAddress = null,
        public readonly ?OrderAddressInput $shippingAddress = null,
        #[ListOf(OrderProductInput::class)]
        public readonly ?array $products = null,
    ) {
    }
}
