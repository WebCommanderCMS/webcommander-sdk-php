<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;

/** The period a figure covers and the one before it, as dates; `time_zone` is the store's and `currency` the code money figures are in. */
final class KpiPeriod extends Dto
{
    public function __construct(
        public readonly ?string $duration = null,
        public readonly ?string $startDate = null,
        public readonly ?string $endDate = null,
        public readonly ?string $previousStartDate = null,
        public readonly ?string $previousEndDate = null,
        public readonly ?string $timeZone = null,
        public readonly ?string $currency = null,
    ) {
    }
}
