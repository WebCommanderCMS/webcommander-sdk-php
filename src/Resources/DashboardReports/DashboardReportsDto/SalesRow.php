<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** One row of the sales report: a day for a period up to a month, else a month. Without `breakdown` only the date fields, `label`, `month_name`, `sales` and `total_sales` are present; `day` is present on day rows only. */
final class SalesRow extends Dto
{
    public function __construct(
        public readonly ?string $date = null,
        public readonly ?int $year = null,
        public readonly ?int $month = null,
        public readonly ?int $day = null,
        public readonly ?string $label = null,
        public readonly ?string $monthName = null,
        public readonly ?float $sales = null,
        public readonly ?float $totalSales = null,
        public readonly ?int $orders = null,
        public readonly ?float $ordersValue = null,
        public readonly ?float $grossSales = null,
        public readonly ?float $shipping = null,
        public readonly ?float $handling = null,
        public readonly ?float $tax = null,
        public readonly ?float $discount = null,
        public readonly ?float $refunds = null,
        public readonly ?float $averageOrderValue = null,
        public readonly ?ReportEntity $topProduct = null,
    ) {
    }
}
