<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The media order body, no envelope: `type` `images` and every image's `id` once, in the order wanted. */
final class ProductMediaOrderInput extends Dto
{
    /** @param list<int|null>|null $ids */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?array $ids = null,
    ) {
    }
}
