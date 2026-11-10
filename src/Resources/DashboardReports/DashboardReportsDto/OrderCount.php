<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** Orders placed in one month. */
final class OrderCount extends Dto
{
    public function __construct(
        public readonly ?string $date = null,
        public readonly ?int $year = null,
        public readonly ?int $month = null,
        public readonly ?int $count = null,
    ) {
    }
}
