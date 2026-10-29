<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The writable form of `Blog`, for the create, the replace and the patch. `$title` is required by
 *  the first two and `$visibility` by the replace. */
final class BlogInput extends Dto
{
    public const ENVELOPE_KEY = 'blog';

    /** @param list<BlogCategoryReference|null>|null $categories */
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $content = null,
        public readonly ?string $date = null,
        public readonly ?bool $isPublished = null,
        public readonly ?string $visibility = null,
        public readonly ?string $visibleTo = null,
        #[ListOf(BlogCategoryReference::class)]
        public readonly ?array $categories = null,
        public readonly ?BlogImageInput $image = null,
        public readonly ?BlogSeoConfigs $seoConfigs = null,
        public readonly ?BlogAudienceInput $selectedCustomers = null,
    ) {
    }
}
