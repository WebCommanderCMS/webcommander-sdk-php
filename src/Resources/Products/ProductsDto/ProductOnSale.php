<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The sale price; `amount_type` is `on_sale_price_type`. */
final class ProductOnSale extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?float $discountedPrice = null,
        public readonly ?string $amountType = null,
    ) {
    }
}
