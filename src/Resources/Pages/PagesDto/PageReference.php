<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;

/** An `{id, name}` pair: the layout, an access-list customer or group, the navigation and the
 *  author. A write names one by `{"id": ...}`; `$name` is read-only. */
final class PageReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
