<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;

/** The five-key `pagination` block; there is no next-page link, so step `offset`. */
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
