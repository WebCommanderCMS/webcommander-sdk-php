<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** A page and its views. */
final class SectionTopPage extends Dto
{
    public function __construct(
        public readonly ?SectionEntity $page = null,
        public readonly ?int $views = null,
    ) {
    }
}
