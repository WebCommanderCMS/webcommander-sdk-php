<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One product video, on the product or on a variant. */
final class ProductVideo extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $filename = null,
        public readonly ?string $thumbnail = null,
        public readonly ?string $link = null,
    ) {
    }
}
