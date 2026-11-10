<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** Customers registered in the period. */
final class ReportCustomers extends Dto
{
    public function __construct(
        public readonly ?int $new = null,
    ) {
    }
}
