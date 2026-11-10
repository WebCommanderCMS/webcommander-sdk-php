<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards\DashboardsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The listing: every layout of the admin, with no paging. */
final class DashboardListing extends Dto
{
    /**
     * @param list<DashboardSummary|null>|null $dashboards
     */
    public function __construct(
        #[ListOf(DashboardSummary::class)]
        public readonly ?array $dashboards = null,
    ) {
    }
}
