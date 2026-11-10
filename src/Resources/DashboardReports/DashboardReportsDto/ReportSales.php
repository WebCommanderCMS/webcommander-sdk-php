<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** Sales figures of the period, rounded to 2 decimals. */
final class ReportSales extends Dto
{
    public function __construct(
        public readonly ?float $subtotal = null,
        public readonly ?float $total = null,
        public readonly ?int $itemsSold = null,
        public readonly ?float $averageOrderValue = null,
    ) {
    }
}
