<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** One row of the most viewed list: a `page` or, with `entity_name` `product`, a `product`. */
final class ReportViewItem extends Dto
{
    public function __construct(
        public readonly ?ReportEntity $page = null,
        public readonly ?ReportEntity $product = null,
        public readonly ?int $views = null,
    ) {
    }
}
