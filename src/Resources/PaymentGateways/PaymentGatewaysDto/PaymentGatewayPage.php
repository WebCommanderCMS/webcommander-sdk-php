<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, without `settings`, and where they sit. */
final class PaymentGatewayPage extends Dto
{
    /** @param list<PaymentGateway|null>|null $paymentGateways */
    public function __construct(
        #[ListOf(PaymentGateway::class)]
        public readonly ?array $paymentGateways = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
