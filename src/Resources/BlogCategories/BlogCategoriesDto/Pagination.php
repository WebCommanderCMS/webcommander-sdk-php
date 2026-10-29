<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories\BlogCategoriesDto;

use WebCommander\Client\Dto;

/** The listing's ten-key `pagination` block; `$limit` is the size the store applied. */
final class Pagination extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
        public readonly ?int $limit = null,
        public readonly ?int $offset = null,
        public readonly ?int $count = null,
        public readonly ?int $currentPage = null,
        public readonly ?int $totalPages = null,
        public readonly ?bool $hasNext = null,
        public readonly ?bool $hasPrevious = null,
        public readonly ?string $previousPage = null,
        public readonly ?string $nextPage = null,
    ) {
    }
}
