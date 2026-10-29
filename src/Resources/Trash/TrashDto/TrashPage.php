<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows and where they sit. */
final class TrashPage extends Dto
{
    /** @param list<TrashItem|null>|null $items */
    public function __construct(
        #[ListOf(TrashItem::class)]
        public readonly ?array $items = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
