<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** Page views of the period. */
final class ReportPageViews extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
        public readonly ?int $unique = null,
    ) {
    }
}
