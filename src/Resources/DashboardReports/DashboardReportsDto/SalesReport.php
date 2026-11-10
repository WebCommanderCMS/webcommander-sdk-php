<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The sales report. `group_by` is `day` for a period up to a month and `month` for a longer one; `sort` (`date` or `sales`) and `order` (`asc` or `desc`) echo what was applied. A period with no sales has no rows. */
final class SalesReport extends Dto
{
    /**
     * @param list<SalesRow|null>|null $rows
     */
    public function __construct(
        public readonly ?ReportPeriod $period = null,
        public readonly ?string $groupBy = null,
        public readonly ?string $sort = null,
        public readonly ?string $order = null,
        #[ListOf(SalesRow::class)]
        public readonly ?array $rows = null,
        public readonly ?SalesTotals $totals = null,
    ) {
    }
}
