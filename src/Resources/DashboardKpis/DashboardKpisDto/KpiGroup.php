<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** A group of metrics: `ecommerce`, `content`, `blog`, `bookings` or `courses`. */
final class KpiGroup extends Dto
{
    /**
     * @param list<KpiMetric|null>|null $metrics
     */
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $label = null,
        #[ListOf(KpiMetric::class)]
        public readonly ?array $metrics = null,
    ) {
    }
}
