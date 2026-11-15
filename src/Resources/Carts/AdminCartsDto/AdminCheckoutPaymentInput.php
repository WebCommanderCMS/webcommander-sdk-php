<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The payment a confirm records. `$amount` and `$paymentMethod` are required; an `$amount` above what is due is refused. */
final class AdminCheckoutPaymentInput extends Dto
{
    public function __construct(
        public readonly ?float $amount = null,
        public readonly ?string $paymentStatus = null,
        public readonly ?string $paymentMethod = null,
        public readonly ?string $transactionReference = null,
        public readonly ?string $transactionDate = null,
    ) {
    }
}
