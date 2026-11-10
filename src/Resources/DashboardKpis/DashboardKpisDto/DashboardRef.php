<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;

/** The default layout the KPI tiles belong to; `id` is its `dashboard_id`. */
final class DashboardRef extends Dto
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
