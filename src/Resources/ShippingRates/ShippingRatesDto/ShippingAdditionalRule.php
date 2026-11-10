<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates\ShippingRatesDto;

use WebCommander\Client\Dto;

/** The charge for each item past the first; the other two keys read null while `$enabled` is false, and `$enabled` true needs both. */
final class ShippingAdditionalRule extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?int $forEachAdditional = null,
        public readonly ?float $additionalCost = null,
    ) {
    }
}
