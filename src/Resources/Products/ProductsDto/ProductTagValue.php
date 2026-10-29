<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One value of a product tag. */
final class ProductTagValue extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $title = null,
        public readonly ?string $value = null,
        public readonly ?string $url = null,
    ) {
    }
}
