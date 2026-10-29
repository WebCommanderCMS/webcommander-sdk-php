<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, and the schema when it was asked for. */
final class CustomerGroupPage extends Dto
{
    /** @param list<CustomerGroup|null>|null $customerGroups */
    public function __construct(
        #[ListOf(CustomerGroup::class)]
        public readonly ?array $customerGroups = null,
        public readonly ?Pagination $pagination = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
