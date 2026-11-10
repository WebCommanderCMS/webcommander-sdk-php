<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The tiles in use with their figures for the period; the read and the save answer alike. */
final class KpiSelection extends Dto
{
    /**
     * @param list<KpiTile|null>|null $selected
     */
    public function __construct(
        public readonly ?DashboardRef $dashboard = null,
        public readonly ?bool $onlineStore = null,
        public readonly ?KpiPeriod $period = null,
        #[ListOf(KpiTile::class)]
        public readonly ?array $selected = null,
    ) {
    }
}
