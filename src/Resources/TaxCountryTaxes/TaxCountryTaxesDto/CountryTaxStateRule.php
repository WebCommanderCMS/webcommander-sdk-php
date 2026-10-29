<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCountryTaxes\TaxCountryTaxesDto;

use WebCommander\Client\Dto;

/** One entry of a country tax's `state_rules`, sent only by the row path and the update. */
final class CountryTaxStateRule extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?TaxState $state = null,
        public readonly ?string $addressLine1 = null,
        public readonly ?string $addressLine2 = null,
        public readonly ?string $city = null,
        public readonly ?string $postCode = null,
        public readonly ?float $taxRate = null,
        public readonly ?string $taxRule = null,
        public readonly ?float $effectiveTaxRate = null,
        public readonly ?bool $isDefault = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly mixed $lastUpdatedBy = null,
    ) {
    }
}
