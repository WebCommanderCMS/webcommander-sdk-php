<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The external links of one trashed item: its `type` and `id`, and `links`. */
final class TrashExternalLinks extends Dto
{
    /** @param list<TrashExternalLink|null>|null $links */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?int $id = null,
        #[ListOf(TrashExternalLink::class)]
        public readonly ?array $links = null,
    ) {
    }
}
