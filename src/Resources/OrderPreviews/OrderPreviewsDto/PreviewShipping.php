<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The delivery the preview was priced for. A `store_pickup` has no shipping cost. */
final class PreviewShipping extends Dto
{
    public function __construct(
        public readonly ?string $deliveryType = null,
        public readonly ?string $shippingType = null,
        public readonly ?float $shippingCost = null,
        public readonly ?float $shippingTax = null,
    ) {
    }
}
