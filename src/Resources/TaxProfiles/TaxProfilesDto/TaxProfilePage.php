<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxProfiles\TaxProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. */
final class TaxProfilePage extends Dto
{
    /** @param list<TaxProfile|null>|null $taxProfiles */
    public function __construct(
        #[ListOf(TaxProfile::class)]
        public readonly ?array $taxProfiles = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
