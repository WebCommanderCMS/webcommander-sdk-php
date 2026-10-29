<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One blog category: a listing row, a row path's body and every write's answer, the same eleven
 *  fields each time. The row never lists the blogs it holds. */
final class BlogCategory extends Dto
{
    public const ENVELOPE_KEY = 'blog_category';

    /** @param list<BlogCategorySeoConfig|null>|null $seoConfigs */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $uuid = null,
        public readonly ?string $name = null,
        public readonly ?string $url = null,
        public readonly ?string $description = null,
        public readonly ?bool $isDisposable = null,
        public readonly ?bool $isInTrash = null,
        public readonly ?BlogCategoryImage $image = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        #[ListOf(BlogCategorySeoConfig::class)]
        public readonly ?array $seoConfigs = null,
    ) {
    }
}
