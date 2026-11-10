<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The body of a coupon or gift card call: `$code`, required, at most 100 characters. */
final class OrderPreviewCodeInput extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
    ) {
    }
}
