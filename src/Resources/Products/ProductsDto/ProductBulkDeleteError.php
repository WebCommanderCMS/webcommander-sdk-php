<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One id the bulk delete did not trash; `$reason` is `not_found` for an unknown id. */
final class ProductBulkDeleteError extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $reason = null,
    ) {
    }
}
