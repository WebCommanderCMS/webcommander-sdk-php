<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** At most one coupon and one gift card; null for one not applied. */
final class PreviewDiscounts extends Dto
{
    public function __construct(
        public readonly ?PreviewCoupon $coupon = null,
        public readonly ?PreviewGiftCard $giftCard = null,
    ) {
    }
}
