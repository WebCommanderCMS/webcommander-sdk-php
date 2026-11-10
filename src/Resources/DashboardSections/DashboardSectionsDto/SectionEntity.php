<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** A product, page or post by id and name. */
final class SectionEntity extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
