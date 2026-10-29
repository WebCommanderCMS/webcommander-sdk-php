<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One variant image. */
final class ProductCombinationImage extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $thumbnail = null,
        public readonly ?string $url = null,
    ) {
    }
}
