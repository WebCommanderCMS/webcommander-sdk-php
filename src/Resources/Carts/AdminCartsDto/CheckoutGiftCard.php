<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The gift card applied: `$appliedAmount` is the lesser of its balance and the grand total. */
final class CheckoutGiftCard extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $status = null,
        public readonly ?float $appliedAmount = null,
        public readonly ?float $remainingBalance = null,
    ) {
    }
}
