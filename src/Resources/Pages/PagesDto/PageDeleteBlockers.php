<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The delete check's body: whether a delete would pass, what blocks it and what links to the
 *  page. `$linked` was empty on every page read, so its rows stay untyped. */
final class PageDeleteBlockers extends Dto
{
    /** @param list<PageDeleteBlocker|null>|null $blockers
     *  @param list<mixed>|null $linked */
    public function __construct(
        public readonly ?bool $canDelete = null,
        #[ListOf(PageDeleteBlocker::class)]
        public readonly ?array $blockers = null,
        public readonly ?array $linked = null,
    ) {
    }
}
