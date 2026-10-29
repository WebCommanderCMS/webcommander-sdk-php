<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** The membership body: the whole member list, replacing the stored one; `[]` empties it. */
final class CustomerGroupCustomersInput extends Dto
{
    /** @param list<int|string>|null $customers */
    public function __construct(
        public readonly ?array $customers = null,
    ) {
    }
}
