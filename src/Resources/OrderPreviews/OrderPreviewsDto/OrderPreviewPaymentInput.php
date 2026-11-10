<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The payment a confirm records. `$amount` above what is due is `422`, a missing `$paymentMethod` is `400`, and `$paymentStatus` `failed` leaves the order unpaid. */
final class OrderPreviewPaymentInput extends Dto
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
