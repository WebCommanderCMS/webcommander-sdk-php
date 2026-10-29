<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, where they sit, `group_meta`, and the schema when asked for. */
final class DiscountProfilePage extends Dto
{
    /** @param list<DiscountProfile|null>|null $discountProfiles */
    public function __construct(
        #[ListOf(DiscountProfile::class)]
        public readonly ?array $discountProfiles = null,
        public readonly ?Pagination $pagination = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
