<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards\DashboardsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** A section of a layout. The standard ones are `announcement`, `performance`, `activity` and `contact`; they only show or hide, and `contact` cannot hide. The customisable ones are `setup_guide`, `section_tabs` (with `tabs`) and `seo` (with `parts`); they also take a `position`. Read back, the title, description and `can_hide` come with it; a write needs only `key` and what changes. */
final class DashboardSection extends Dto
{
    /**
     * @param list<DashboardTab|null>|null $tabs
     * @param list<DashboardPart|null>|null $parts
     */
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?bool $visible = null,
        public readonly ?bool $canHide = null,
        public readonly ?int $position = null,
        #[ListOf(DashboardTab::class)]
        public readonly ?array $tabs = null,
        #[ListOf(DashboardPart::class)]
        public readonly ?array $parts = null,
    ) {
    }
}
