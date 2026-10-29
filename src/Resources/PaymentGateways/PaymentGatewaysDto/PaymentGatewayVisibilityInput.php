<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The visibility a write takes: customers and customer groups by id. */
final class PaymentGatewayVisibilityInput extends Dto
{
    /** @param list<int>|null $customers
     *  @param list<int>|null $customerGroups */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?array $customers = null,
        public readonly ?array $customerGroups = null,
    ) {
    }
}
