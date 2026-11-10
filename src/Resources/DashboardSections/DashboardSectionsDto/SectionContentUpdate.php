<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** One content item to review; `count` is an empty string on the rows measured. */
final class SectionContentUpdate extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $label = null,
        public readonly ?string $count = null,
    ) {
    }
}
