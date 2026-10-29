<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The expect-to-pay price. */
final class ProductExpectToPay extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?float $price = null,
    ) {
    }
}
