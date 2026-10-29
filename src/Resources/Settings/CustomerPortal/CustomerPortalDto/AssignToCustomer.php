<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `assign_to_customer` block: the assigned-pages tab and how it paginates. */
final class AssignToCustomer extends Dto
{
    /** @param list<ProfileEntry|null>|null $items */
    public function __construct(
        #[ListOf(ProfileEntry::class)]
        public readonly ?array $items = null,
        public readonly ?string $showPagination = null,
        public readonly ?int $itemPerPage = null,
    ) {
    }
}
