<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The custom code added to the product page's header and footer. */
final class ProductSeoCustomCode extends Dto
{
    public function __construct(
        public readonly ?ProductSeoCode $header = null,
        public readonly ?ProductSeoCode $footer = null,
    ) {
    }
}
