<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** What needs attention now; `pending_fulfillment` is the orders waiting to ship. */
final class SectionOrderUpdates extends Dto
{
    public function __construct(
        public readonly ?int $lowStockItems = null,
        public readonly ?int $pendingFulfillment = null,
        public readonly ?int $paymentsToCapture = null,
    ) {
    }
}
