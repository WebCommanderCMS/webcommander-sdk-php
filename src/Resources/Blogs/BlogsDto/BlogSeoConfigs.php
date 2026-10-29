<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** `seo_configs`, an object holding the `meta_tag` list. */
final class BlogSeoConfigs extends Dto
{
    /** @param list<BlogMetaTag|null>|null $metaTag */
    public function __construct(
        #[ListOf(BlogMetaTag::class)]
        public readonly ?array $metaTag = null,
    ) {
    }
}
