<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The quick report. `kpis` holds the 27 metrics, or only the ones the query's `kpis` names, in that order. Inside a summary only the grouped totals and `view_report` are present. */
final class QuickReport extends Dto
{
    /**
     * @param list<ReportKpi|null>|null $kpis
     * @param list<ReportKpi|null>|null $trends
     */
    public function __construct(
        public readonly ?ReportPeriod $period = null,
        #[ListOf(ReportKpi::class)]
        public readonly ?array $kpis = null,
        public readonly ?ReportOrders $orders = null,
        public readonly ?ReportSales $sales = null,
        public readonly ?ReportCustomers $customers = null,
        public readonly ?ReportProducts $products = null,
        public readonly ?ReportPageViews $pageViews = null,
        public readonly ?ReportViews $viewReport = null,
        #[ListOf(ReportKpi::class)]
        public readonly ?array $trends = null,
    ) {
    }
}
