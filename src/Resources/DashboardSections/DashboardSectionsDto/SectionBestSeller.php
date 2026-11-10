<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** A product and the units sold, highest first. */
final class SectionBestSeller extends Dto
{
    public function __construct(
        public readonly ?SectionEntity $product = null,
        public readonly ?int $unitsSold = null,
    ) {
    }
}
