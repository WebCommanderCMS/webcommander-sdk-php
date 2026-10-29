<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, `group_meta` and the paging block. */
final class CustomProfilePage extends Dto
{
    /** @param list<CustomProfile|null>|null $customProfiles */
    public function __construct(
        #[ListOf(CustomProfile::class)]
        public readonly ?array $customProfiles = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
