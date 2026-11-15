<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The cart update body: the customer to move the cart to. `$customerId` is required. */
final class AdminCartCustomerInput extends Dto
{
    public function __construct(
        public readonly ?int $customerId = null,
    ) {
    }
}
