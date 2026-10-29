<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;

/** One trashed row, and the `item` a restore answers. `$type` is the snake_case name `types`
 *  answers; `$removedAt` is when the row was trashed, in UTC; `$url` is the record's own path, null
 *  for a `blog_post`. A restore and a bulk delete send no `removed_at`. */
final class TrashItem extends Dto
{
    public const ENVELOPE_KEY = 'item';

    public function __construct(
        public readonly ?string $type = null,
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $removedAt = null,
        public readonly ?string $url = null,
    ) {
    }
}
