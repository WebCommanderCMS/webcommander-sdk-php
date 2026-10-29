<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;

/** One type the trash holds, as a path's `{trash_type}` takes it. */
final class TrashType extends Dto
{
    public function __construct(
        public readonly ?string $type = null,
    ) {
    }
}
