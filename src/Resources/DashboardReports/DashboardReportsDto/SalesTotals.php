<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;

/** The rows added up; `sales` always, the rest with `breakdown`. */
final class SalesTotals extends Dto
{
    public function __construct(
        public readonly ?float $sales = null,
        public readonly ?int $orders = null,
        public readonly ?float $ordersValue = null,
        public readonly ?float $grossSales = null,
        public readonly ?float $shipping = null,
        public readonly ?float $handling = null,
        public readonly ?float $tax = null,
        public readonly ?float $discount = null,
        public readonly ?float $refunds = null,
        public readonly ?float $averageOrderValue = null,
    ) {
    }
}
