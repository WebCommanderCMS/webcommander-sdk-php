<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `details` block: which parts of the product's own description are shown. */
final class ProductDetails extends Dto
{
    public function __construct(
        public readonly ?bool $displayDescription = null,
        public readonly ?bool $displaySalePercentage = null,
        public readonly ?bool $useStrikeThroughOnPreviousPrice = null,
        public readonly ?bool $displayTaxWithExpectToPayPrice = null,
    ) {
    }
}
