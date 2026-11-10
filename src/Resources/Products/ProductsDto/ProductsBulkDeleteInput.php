<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The bulk delete's body, no envelope: `$ids` is required and must not be empty. */
final class ProductsBulkDeleteInput extends Dto
{
    /** @param list<int|null>|null $ids */
    public function __construct(
        public readonly ?array $ids = null,
    ) {
    }
}
