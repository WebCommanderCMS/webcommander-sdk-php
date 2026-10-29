<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `types` body: every type, alphabetical. */
final class TrashTypeList extends Dto
{
    /** @param list<TrashType|null>|null $types */
    public function __construct(
        #[ListOf(TrashType::class)]
        public readonly ?array $types = null,
    ) {
    }
}
