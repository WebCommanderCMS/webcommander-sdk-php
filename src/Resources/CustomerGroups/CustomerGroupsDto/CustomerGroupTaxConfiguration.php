<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** `$basePriceRounding` is `nearest`, `up` or `down`. */
final class CustomerGroupTaxConfiguration extends Dto
{
    public function __construct(
        public readonly ?bool $overrideStoreTax = null,
        public readonly ?bool $taxExempt = null,
        public readonly ?string $taxMessage = null,
        public readonly ?bool $showPricesWithTaxIncluded = null,
        public readonly ?bool $pricesEnteredWithTaxIncluded = null,
        public readonly ?string $basePriceRounding = null,
    ) {
    }
}
