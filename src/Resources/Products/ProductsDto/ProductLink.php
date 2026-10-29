<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** A related, similar or up-sell product. A write takes `{"id": ...}`; a list of bare ids in
 *  `up_sell_products` is answered `200` and leaves it empty. */
final class ProductLink extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $url = null,
        public readonly ?string $status = null,
        public readonly ?string $sku = null,
        public readonly ?bool $inStock = null,
        public readonly ?float $price = null,
    ) {
    }
}
