<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards\DashboardsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The write body, bare. A create needs `name`, unique among the admin's layouts (`409`); it starts as a copy of the `copy_from` layout, the default one when that is left out. A patch sends only what changes; the sections named are merged into the layout, the rest is kept. `kpis` is the full list of 2 to 5 metric keys in tile order. A standard section takes no `position` (`400`). `default` `true` makes this layout the store's default layout; `false` on the default layout is `409`, as the default moves only by making another layout the default. */
final class DashboardInput extends Dto
{
    /**
     * @param list<DashboardSection|null>|null $standardSections
     * @param list<DashboardSection|null>|null $customisableSections
     * @param list<string|null>|null $kpis
     */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?bool $default = null,
        public readonly ?string $copyFrom = null,
        #[ListOf(DashboardSection::class)]
        public readonly ?array $standardSections = null,
        #[ListOf(DashboardSection::class)]
        public readonly ?array $customisableSections = null,
        public readonly ?array $kpis = null,
    ) {
    }
}
