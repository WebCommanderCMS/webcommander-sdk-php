<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates\ShippingRatesDto;

use WebCommander\Client\Dto;

/** The count sub-path's body, a bare `{"total": N}`. */
final class ShippingRateCount extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
    ) {
    }
}
