<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** The five-key `pagination` block; `$limit` is the page size applied, the one asked for or 20. */
final class Pagination extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
        public readonly ?int $limit = null,
        public readonly ?int $offset = null,
        public readonly ?bool $hasPrevious = null,
        public readonly ?bool $hasNext = null,
    ) {
    }
}
