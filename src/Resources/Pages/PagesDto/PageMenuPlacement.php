<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;

/** Whether the page is linked from a navigation; `$navigation` is null when it is not, and must
 *  be `{"id": ...}` when a write sends `enabled` true. */
final class PageMenuPlacement extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?PageReference $navigation = null,
    ) {
    }
}
