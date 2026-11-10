<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards\DashboardsDto;

use WebCommander\Client\Dto;

/** One KPI tile of a layout, in tile order. `key` is a `kpi_options` metric key. */
final class DashboardKpi extends Dto
{
    public function __construct(
        public readonly ?int $position = null,
        public readonly ?string $key = null,
        public readonly ?string $label = null,
        public readonly ?string $group = null,
    ) {
    }
}
