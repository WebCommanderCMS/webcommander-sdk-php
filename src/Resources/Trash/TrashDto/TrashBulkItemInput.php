<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;

/** One item of a bulk body; `$type` in any letter case, `$id` a number. */
final class TrashBulkItemInput extends Dto
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?int $id = null,
    ) {
    }
}
