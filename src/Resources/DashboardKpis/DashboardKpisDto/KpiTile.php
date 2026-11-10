<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;

/** One selected tile with its figure. `format` is `money`, `count` or `percent` and `direction` is `up`, `down` or `flat`; `change_percent` is `None` when the previous period was zero. Every count is a float on the wire. */
final class KpiTile extends Dto
{
    public function __construct(
        public readonly ?int $position = null,
        public readonly ?string $key = null,
        public readonly ?string $code = null,
        public readonly ?string $label = null,
        public readonly ?string $group = null,
        public readonly ?string $format = null,
        public readonly ?float $value = null,
        public readonly ?float $previousValue = null,
        public readonly ?float $changePercent = null,
        public readonly ?string $direction = null,
    ) {
    }
}
