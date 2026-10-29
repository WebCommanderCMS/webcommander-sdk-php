<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The addresses sub-path's body; at least one address, and one left out is untouched. */
final class OrderAddressesInput extends Dto
{
    public function __construct(
        public readonly ?string $transactionNo = null,
        public readonly ?OrderAddressInput $billingAddress = null,
        public readonly ?OrderAddressInput $shippingAddress = null,
    ) {
    }
}
