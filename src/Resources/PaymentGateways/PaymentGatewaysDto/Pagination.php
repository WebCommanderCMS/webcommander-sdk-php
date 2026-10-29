<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The five-key `pagination` block; `$limit` is the page size applied. `$hasPrevious` is true past
 *  the first page and false on a page past the end. */
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
