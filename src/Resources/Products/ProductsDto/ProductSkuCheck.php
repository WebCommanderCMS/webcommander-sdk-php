<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** A SKU's verdict: `$available` and `$isExist` are opposites, `$product` and `$id` name the holder
 *  and are `null` or absent when the SKU is free. A variant's SKU names the variant's own product. */
final class ProductSkuCheck extends Dto
{
    public function __construct(
        public readonly ?bool $available = null,
        public readonly ?bool $isExist = null,
        public readonly ?ProductSkuHolder $product = null,
        public readonly ?int $id = null,
    ) {
    }
}
