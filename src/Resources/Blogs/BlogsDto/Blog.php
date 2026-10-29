<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One blog, the same eighteen fields on a listing row, a row read and every write's answer. `url`
 *  is the title's slug on the create; a later write naming `title` takes a sent one. */
final class Blog extends Dto
{
    public const ENVELOPE_KEY = 'blog';

    /** @param list<BlogCategoryReference|null>|null $categories */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $uuid = null,
        public readonly ?string $title = null,
        public readonly ?string $url = null,
        public readonly ?string $content = null,
        public readonly ?string $date = null,
        public readonly ?bool $isPublished = null,
        public readonly ?string $visibility = null,
        public readonly ?string $visibleTo = null,
        #[ListOf(BlogCategoryReference::class)]
        public readonly ?array $categories = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly ?bool $isDisposable = null,
        public readonly ?bool $isInTrash = null,
        public readonly ?BlogImage $image = null,
        public readonly ?BlogAuthor $createdBy = null,
        public readonly ?BlogAudience $selectedCustomers = null,
        public readonly ?BlogSeoConfigs $seoConfigs = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
