<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The bulk body, `{"items": [...]}`, 1 to 100 items; no envelope. */
final class TrashBulkInput extends Dto
{
    /** @param list<TrashBulkItemInput|null>|null $items */
    public function __construct(
        #[ListOf(TrashBulkItemInput::class)]
        public readonly ?array $items = null,
    ) {
    }
}
