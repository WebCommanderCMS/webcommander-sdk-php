<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** The one `group_meta` entry: what the collection is, whether it is writable and where. */
final class ResourceMeta extends Dto
{
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?bool $writable = null,
        public readonly ?string $href = null,
    ) {
    }
}
