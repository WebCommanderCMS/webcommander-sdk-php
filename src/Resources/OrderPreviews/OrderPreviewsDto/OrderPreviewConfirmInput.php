<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The confirm body, bare, and optional. `$paymentGateway` takes a code such as `PIS` and leaves the order unpaid; an unknown field is `400`. */
final class OrderPreviewConfirmInput extends Dto
{
    public function __construct(
        public readonly ?string $paymentGateway = null,
        public readonly ?string $transactionNo = null,
        public readonly ?bool $sendEmail = null,
        public readonly ?OrderPreviewPaymentInput $payment = null,
    ) {
    }
}
