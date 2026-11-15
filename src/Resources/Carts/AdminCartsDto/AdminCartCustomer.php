<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The customer the cart is for; `$customerId` is the customer's normal id. */
final class AdminCartCustomer extends Dto
{
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $email = null,
    ) {
    }
}
