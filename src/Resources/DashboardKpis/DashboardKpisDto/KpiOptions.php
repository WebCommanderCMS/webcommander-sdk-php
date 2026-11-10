<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis\DashboardKpisDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** Every metric a tile can show. `min` and `max` bound the number of tiles, and `selected` lists the keys in use, in tile order. */
final class KpiOptions extends Dto
{
    /**
     * @param list<string|null>|null $selected
     * @param list<KpiGroup|null>|null $groups
     */
    public function __construct(
        public readonly ?DashboardRef $dashboard = null,
        public readonly ?int $min = null,
        public readonly ?int $max = null,
        public readonly ?array $selected = null,
        #[ListOf(KpiGroup::class)]
        public readonly ?array $groups = null,
    ) {
    }
}
