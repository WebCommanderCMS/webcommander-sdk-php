<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The bundle block; `bundle` is null on a product that is not a bundle. No bundle item was read,
 *  so `$items` is untyped. */
final class ProductBundle extends Dto
{
    /** @param list<mixed>|null $items */
    public function __construct(
        public readonly ?bool $priceFixed = null,
        public readonly ?bool $quantityFlexible = null,
        public readonly ?array $items = null,
    ) {
    }
}
