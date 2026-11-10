<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards\DashboardsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One layout. `id` is the `dashboard_id` of the other calls, a UUID. Exactly one layout is the default. */
final class Dashboard extends Dto
{
    /**
     * @param list<DashboardSection|null>|null $standardSections
     * @param list<DashboardSection|null>|null $customisableSections
     * @param list<DashboardKpi|null>|null $kpis
     */
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $default = null,
        #[ListOf(DashboardSection::class)]
        public readonly ?array $standardSections = null,
        #[ListOf(DashboardSection::class)]
        public readonly ?array $customisableSections = null,
        #[ListOf(DashboardKpi::class)]
        public readonly ?array $kpis = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
