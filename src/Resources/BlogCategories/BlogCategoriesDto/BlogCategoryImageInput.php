<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** An image upload; `title` and `alternative_text` are stored only beside a `base64`. */
final class BlogCategoryImageInput extends Dto
{
    public function __construct(
        public readonly ?string $fileName = null,
        #[WireName('base64')]
        public readonly ?string $base64 = null,
        public readonly ?string $title = null,
        public readonly ?string $alternativeText = null,
    ) {
    }
}
