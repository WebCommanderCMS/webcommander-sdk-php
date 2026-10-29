<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The `tax_shipping` section, the same eight fields read and written. Naming a
 *  `shipping_profile` sets `enable_shipping`, and `enable_shipping: false` clears it. */
final class CategoryTaxShipping extends Dto
{
    public function __construct(
        public readonly ?bool $taxExempt = null,
        public readonly ?CategoryReference $taxProfile = null,
        public readonly ?string $taxMessage = null,
        public readonly ?bool $showPriceWithTax = null,
        public readonly ?bool $pricesEnteredWithTax = null,
        public readonly ?string $basePriceRounding = null,
        public readonly ?bool $enableShipping = null,
        public readonly ?CategoryReference $shippingProfile = null,
    ) {
    }
}
