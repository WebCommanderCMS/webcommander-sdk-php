<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** The assign body, both ids bare: `$customer` is a `customer_id`. */
final class CustomerGroupAssignInput extends Dto
{
    public function __construct(
        public readonly int|string|null $customer = null,
        public readonly int|string|null $group = null,
    ) {
    }
}
