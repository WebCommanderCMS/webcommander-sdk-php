<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The bulk delete's body: the rows deleted, each `type`, `id` and `name`, and an entry per
 *  failed item. */
final class TrashBulkDeleteResult extends Dto
{
    /** @param list<TrashItem|null>|null $deleted
     *  @param list<TrashBulkError|null>|null $failed */
    public function __construct(
        #[ListOf(TrashItem::class)]
        public readonly ?array $deleted = null,
        #[ListOf(TrashBulkError::class)]
        public readonly ?array $failed = null,
    ) {
    }
}
