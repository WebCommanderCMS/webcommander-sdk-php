<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates\ShippingRatesDto;

use WebCommander\Client\Dto;

/** An `{id, name}` pair: a rule that uses the rate. */
final class ShippingReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
