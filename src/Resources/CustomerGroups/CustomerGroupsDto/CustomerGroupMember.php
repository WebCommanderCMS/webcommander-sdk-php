<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** One member, by its `customer_id`: an entry of `customers` and the membership read. */
final class CustomerGroupMember extends Dto
{
    public const ENVELOPE_KEY = 'customer';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $email = null,
    ) {
    }
}
