<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** One image upload: a file name and its bytes as base64. */
final class CategoryImage extends Dto
{
    public function __construct(
        public readonly ?string $filename = null,
        #[WireName('base64')]
        public readonly ?string $base64 = null,
    ) {
    }
}
