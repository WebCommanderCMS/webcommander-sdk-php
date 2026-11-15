<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The body of a coupon or gift card call: `$code`, required. */
final class AdminCheckoutCodeInput extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
    ) {
    }
}
