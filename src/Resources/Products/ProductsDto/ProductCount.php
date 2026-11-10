<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The count's answer; `$count` repeats `$total`. */
final class ProductCount extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
        public readonly ?int $count = null,
    ) {
    }
}
