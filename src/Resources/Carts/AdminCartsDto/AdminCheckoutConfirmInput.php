<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The confirm body, bare, and optional. `$paymentGateway` takes one of the store's codes, such as `PIS`; an unknown field is `400`. */
final class AdminCheckoutConfirmInput extends Dto
{
    public function __construct(
        public readonly ?string $paymentGateway = null,
        public readonly ?string $transactionNo = null,
        public readonly ?bool $sendEmail = null,
        public readonly ?AdminCheckoutPaymentInput $payment = null,
    ) {
    }
}
