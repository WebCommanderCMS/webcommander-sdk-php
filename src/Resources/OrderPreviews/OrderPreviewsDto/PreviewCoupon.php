<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The coupon on the preview: `$amount` is the discount it takes off, `$status` `applied`. */
final class PreviewCoupon extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $status = null,
        public readonly ?float $amount = null,
    ) {
    }
}
