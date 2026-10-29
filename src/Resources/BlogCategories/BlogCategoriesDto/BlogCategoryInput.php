<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The writable form of `BlogCategory`, inside the wrapper both writes require. An update blanks an
 *  unset `$description` and keeps the `url`, the `image` and the blog links. */
final class BlogCategoryInput extends Dto
{
    public const ENVELOPE_KEY = 'blog_category';

    /** @param list<BlogCategoryBlog>|null $blogs */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $url = null,
        public readonly ?string $description = null,
        public readonly ?BlogCategoryImageInput $image = null,
        #[ListOf(BlogCategoryBlog::class)]
        public readonly ?array $blogs = null,
    ) {
    }
}
