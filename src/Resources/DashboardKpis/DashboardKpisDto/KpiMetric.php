<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;

/** One metric a tile can show. `key` is what a selection takes; `code` is the report's own name for it and differs for some, such as `aov` and `average_order_value`. */
final class KpiMetric extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $code = null,
        public readonly ?string $label = null,
        public readonly ?string $format = null,
        public readonly ?bool $inUse = null,
    ) {
    }
}
