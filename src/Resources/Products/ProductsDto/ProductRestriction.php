<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** A price or purchase restriction. Only `mode` is written; `enabled` is read-only and
 *  `customers` is answered `200` but kept empty. */
final class ProductRestriction extends Dto
{
    /** @param list<mixed>|null $customers */
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $mode = null,
        public readonly ?array $customers = null,
    ) {
    }
}
