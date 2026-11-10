<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards\DashboardsDto;

use WebCommander\Client\Dto;

/** One tab of the `section_tabs` section: `ecommerce`, `content`, `bookings`, `courses` or `blog`. A write needs `key` and sets `visible` or `position`, counted from 1 among the tabs. */
final class DashboardTab extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?bool $visible = null,
        public readonly ?bool $canHide = null,
        public readonly ?int $position = null,
    ) {
    }
}
