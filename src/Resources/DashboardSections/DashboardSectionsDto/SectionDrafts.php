<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The blog drafts to publish: how many, and the latest. */
final class SectionDrafts extends Dto
{
    /**
     * @param list<SectionDraft|null>|null $latest
     */
    public function __construct(
        public readonly ?int $count = null,
        #[ListOf(SectionDraft::class)]
        public readonly ?array $latest = null,
    ) {
    }
}
