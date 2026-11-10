<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** A product and its views. */
final class MostVisitedProduct extends Dto
{
    public function __construct(
        public readonly ?ReportEntity $product = null,
        public readonly ?int $views = null,
    ) {
    }
}
