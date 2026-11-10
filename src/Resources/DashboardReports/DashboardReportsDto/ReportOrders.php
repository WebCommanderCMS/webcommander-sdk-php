<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** Order counts of the period. */
final class ReportOrders extends Dto
{
    public function __construct(
        public readonly ?int $count = null,
        public readonly ?int $pending = null,
        public readonly ?int $cancelled = null,
    ) {
    }
}
