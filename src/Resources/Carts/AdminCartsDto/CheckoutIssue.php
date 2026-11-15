<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** One thing still blocking a confirm, such as `$field` `delivery_type` with `$code` `required`. */
final class CheckoutIssue extends Dto
{
    public function __construct(
        public readonly ?string $field = null,
        public readonly ?string $code = null,
        public readonly ?string $message = null,
    ) {
    }
}
