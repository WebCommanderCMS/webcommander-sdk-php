<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries\CountriesDto;

use WebCommander\Client\Dto;

/** The five-key `pagination` block of both listings; `$limit` is the page size applied, the one
 *  asked for, 20, or under `limit=all` the number of rows that arrived. */
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
