<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The summary: every section of the Dashboard in one answer. `quick_report` has no `kpis`. */
final class SummaryReport extends Dto
{
    /**
     * @param list<OrderCount|null>|null $orderByMonth
     * @param list<OrderCount|null>|null $ordersOverTime
     * @param list<SalesRow|null>|null $salesReport
     * @param list<MostVisitedProduct|null>|null $mostVisitedProducts
     * @param list<BestSellingProduct|null>|null $bestSellingProducts
     */
    public function __construct(
        public readonly ?ReportPeriod $period = null,
        public readonly ?QuickReport $quickReport = null,
        #[ListOf(OrderCount::class)]
        public readonly ?array $orderByMonth = null,
        #[ListOf(OrderCount::class)]
        public readonly ?array $ordersOverTime = null,
        #[ListOf(SalesRow::class)]
        public readonly ?array $salesReport = null,
        #[ListOf(MostVisitedProduct::class)]
        public readonly ?array $mostVisitedProducts = null,
        #[ListOf(BestSellingProduct::class)]
        public readonly ?array $bestSellingProducts = null,
        public readonly ?OrderUpdates $orderUpdates = null,
    ) {
    }
}
