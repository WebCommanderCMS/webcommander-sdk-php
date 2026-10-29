<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use WebCommander\Client\Dto;

/** The `pagination` block of a listing. */
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
