<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One stock change; `delta` is the new figure minus the old. */
final class ProductStockAdjustment extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $delta = null,
        public readonly ?string $note = null,
        public readonly ?string $transactionNo = null,
        public readonly ?ProductStockAdjustmentUser $createdBy = null,
        public readonly ?string $createdAt = null,
    ) {
    }
}
