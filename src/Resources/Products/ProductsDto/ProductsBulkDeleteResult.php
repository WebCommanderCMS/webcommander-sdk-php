<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The bulk delete's answer, `200` even when an id failed: counts, and the failed ids. */
final class ProductsBulkDeleteResult extends Dto
{
    /** @param list<ProductBulkDeleteError|null>|null $errors */
    public function __construct(
        public readonly ?int $deleted = null,
        public readonly ?int $failed = null,
        #[ListOf(ProductBulkDeleteError::class)]
        public readonly ?array $errors = null,
    ) {
    }
}
