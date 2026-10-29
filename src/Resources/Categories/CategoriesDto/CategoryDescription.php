<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The `description` section, the same one field read and written. */
final class CategoryDescription extends Dto
{
    public function __construct(
        public readonly ?string $content = null,
    ) {
    }
}
