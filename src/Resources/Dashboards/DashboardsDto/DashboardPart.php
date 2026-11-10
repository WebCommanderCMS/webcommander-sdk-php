<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards\DashboardsDto;

use WebCommander\Client\Dto;

/** One part of the `seo` section. Read back, the title and `can_hide` come with it; a write needs only `key` and `visible`. The `kpis` part cannot be hidden. */
final class DashboardPart extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $title = null,
        public readonly ?bool $visible = null,
        public readonly ?bool $canHide = null,
    ) {
    }
}
