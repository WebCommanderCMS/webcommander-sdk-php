<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates\ShippingRatesDto;

use WebCommander\Client\Dto;

/** A shipping or handling cost; `$type` is `fixed` or `percent`. */
final class ShippingCost extends Dto
{
    public function __construct(
        public readonly ?float $amount = null,
        public readonly ?string $type = null,
    ) {
    }
}
