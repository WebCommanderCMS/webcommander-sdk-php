<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** One figure with the previous period's. `format` is `money`, `count` or `percent` and `direction` is `up`, `down` or `flat`; `change_percent` is `None` when the previous value was zero. In `trends` there is no `group`. */
final class ReportKpi extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $code = null,
        public readonly ?string $label = null,
        public readonly ?string $group = null,
        public readonly ?string $format = null,
        public readonly ?float $value = null,
        public readonly ?float $previousValue = null,
        public readonly ?float $changePercent = null,
        public readonly ?string $direction = null,
    ) {
    }
}
