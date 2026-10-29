<?php

declare(strict_types=1);

namespace WebCommander\Resources\Aliases\AliasesDto;

use WebCommander\Client\Dto;

/** The listing's five-key `pagination` block; `$limit` is the size the store applied. */
final class Pagination extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
        public readonly ?int $limit = null,
        public readonly ?int $offset = null,
        public readonly ?bool $hasNext = null,
        public readonly ?bool $hasPrevious = null,
    ) {
    }
}
