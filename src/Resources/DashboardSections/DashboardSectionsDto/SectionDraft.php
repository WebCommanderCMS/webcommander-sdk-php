<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** A blog draft waiting to be published. */
final class SectionDraft extends Dto
{
    public function __construct(
        public readonly ?SectionEntity $post = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
