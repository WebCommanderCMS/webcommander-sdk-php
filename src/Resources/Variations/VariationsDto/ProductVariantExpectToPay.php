<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** A variant's expected-price display. */
final class ProductVariantExpectToPay extends Dto
{
    public function __construct(
        public readonly ?bool $isEnabled = null,
        public readonly ?float $price = null,
    ) {
    }
}
