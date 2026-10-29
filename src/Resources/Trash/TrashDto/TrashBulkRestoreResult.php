<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The bulk restore's body: the rows restored, and an entry per failed item. */
final class TrashBulkRestoreResult extends Dto
{
    /** @param list<TrashItem|null>|null $restored
     *  @param list<TrashBulkError|null>|null $failed */
    public function __construct(
        #[ListOf(TrashItem::class)]
        public readonly ?array $restored = null,
        #[ListOf(TrashBulkError::class)]
        public readonly ?array $failed = null,
    ) {
    }
}
