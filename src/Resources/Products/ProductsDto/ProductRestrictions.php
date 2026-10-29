<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** `restrict_price_for` and `restrict_purchase_for` in one block; `enabled` and
 *  `display_only` are read-only. */
final class ProductRestrictions extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?ProductRestriction $price = null,
        public readonly ?ProductRestriction $purchase = null,
        public readonly ?bool $displayOnly = null,
    ) {
    }
}
