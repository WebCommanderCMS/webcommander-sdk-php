<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** Who sees the gateway at checkout; the lists fill only under `type` `selected`. */
final class PaymentGatewayVisibility extends Dto
{
    /** @param list<PaymentGatewayReference|null>|null $customers
     *  @param list<PaymentGatewayReference|null>|null $customerGroups */
    public function __construct(
        public readonly ?string $type = null,
        #[ListOf(PaymentGatewayReference::class)]
        public readonly ?array $customers = null,
        #[ListOf(PaymentGatewayReference::class)]
        public readonly ?array $customerGroups = null,
    ) {
    }
}
