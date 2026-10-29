<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** The assign answer: `$added` is false when the customer was already a member. */
final class CustomerGroupAssignment extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $customerId = null,
        public readonly ?string $email = null,
        public readonly ?CustomerGroup $group = null,
        public readonly ?bool $added = null,
    ) {
    }
}
