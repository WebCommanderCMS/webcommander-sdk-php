<?php

declare(strict_types=1);

namespace WebCommander\Resources\Cities\CitiesDto;

use WebCommander\Client\Dto;

/** The five-key `pagination` block: `$total` is the number of rows that matched, `$limit` the page
 *  size applied and `$offset` the start. */
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
