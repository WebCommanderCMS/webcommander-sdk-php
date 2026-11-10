<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;

/** The save body, bare: `metrics` is the full list of 2 to 5 distinct metric keys, in tile order. It replaces the default layout's tiles. */
final class KpiSelectionInput extends Dto
{
    /**
     * @param list<string|null>|null $metrics
     */
    public function __construct(
        public readonly ?array $metrics = null,
    ) {
    }
}
