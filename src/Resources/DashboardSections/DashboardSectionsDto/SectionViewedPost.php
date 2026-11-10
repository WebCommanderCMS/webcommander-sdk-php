<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** A blog post and its views. */
final class SectionViewedPost extends Dto
{
    public function __construct(
        public readonly ?SectionEntity $post = null,
        public readonly ?int $views = null,
    ) {
    }
}
