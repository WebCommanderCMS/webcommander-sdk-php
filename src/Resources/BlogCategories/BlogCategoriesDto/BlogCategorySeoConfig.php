<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;

/** One `seo_configs` entry; no write here sets the list, so a created category's is empty. */
final class BlogCategorySeoConfig extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $value = null,
        public readonly ?string $type = null,
        public readonly ?string $configKey = null,
    ) {
    }
}
