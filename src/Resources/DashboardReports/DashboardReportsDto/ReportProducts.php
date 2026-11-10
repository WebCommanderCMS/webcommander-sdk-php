<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** Products added in the period, and those out of stock now. */
final class ReportProducts extends Dto
{
    public function __construct(
        public readonly ?int $new = null,
        public readonly ?int $outOfStock = null,
    ) {
    }
}
