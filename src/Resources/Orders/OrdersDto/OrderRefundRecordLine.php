<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One order line a refund was spread over; the money fields are decimal text such as `"1.00"`.
 *  `ext_item_referer` was `null` on every line read, so it is not typed. */
final class OrderRefundRecordLine extends Dto
{
    public function __construct(
        public readonly ?int $orderItemId = null,
        public readonly ?string $productSku = null,
        public readonly ?string $productName = null,
        public readonly mixed $extItemReferer = null,
        public readonly ?bool $pluginLine = null,
        public readonly ?int $quantity = null,
        public readonly ?string $linePaid = null,
        public readonly ?string $amount = null,
        public readonly ?string $lineRefundedTotal = null,
        public readonly ?bool $lineFullyRefunded = null,
    ) {
    }
}
