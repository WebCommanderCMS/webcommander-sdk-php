<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** One `meta_tag` entry, the same two fields on a write and a read. */
final class BlogMetaTag extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $value = null,
    ) {
    }
}
