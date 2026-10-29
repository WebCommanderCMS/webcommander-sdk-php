<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;

/** The draft and approval state; the draft and published ids are null, never `0`. */
final class PagePublishing extends Dto
{
    /** @param list<int|null>|null $pendingApprovalIds */
    public function __construct(
        public readonly ?bool $draft = null,
        public readonly ?int $draftPageId = null,
        public readonly ?int $publishedPageId = null,
        public readonly ?bool $pendingApproval = null,
        public readonly ?int $pendingApprovalCount = null,
        public readonly ?array $pendingApprovalIds = null,
        public readonly ?bool $disposable = null,
    ) {
    }
}
