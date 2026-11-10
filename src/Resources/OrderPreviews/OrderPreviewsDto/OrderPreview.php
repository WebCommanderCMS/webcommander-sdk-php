<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** A preview. The start and the read answer every field; a coupon or gift card call answers only `$session`, `$discounts` and `$totals`. */
final class OrderPreview extends Dto
{
    public const ENVELOPE_KEY = 'order';

    /** @param list<PreviewItem|null>|null $items */
    public function __construct(
        public readonly ?PreviewSession $session = null,
        public readonly ?PreviewCustomer $customer = null,
        public readonly ?string $deliveryType = null,
        public readonly ?string $currencyCode = null,
        #[ListOf(PreviewItem::class)]
        public readonly ?array $items = null,
        public readonly ?PreviewShipping $shipping = null,
        public readonly ?PreviewDiscounts $discounts = null,
        public readonly ?PreviewTotals $totals = null,
    ) {
    }
}
