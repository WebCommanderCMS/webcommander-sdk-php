<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCountryTaxes\TaxCountryTaxesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One country tax; the row path and the update add `$stateRules` to the twelve keys a listing row
 *  and the create answer carry. `$taxMethod` reads lower case, and `$isDefault` is not exclusive. */
final class CountryTax extends Dto
{
    public const ENVELOPE_KEY = 'country_tax';

    /** @param list<CountryTaxStateRule|null>|null $stateRules */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?TaxCountry $country = null,
        public readonly ?string $taxCode = null,
        public readonly ?float $taxRate = null,
        public readonly ?string $taxMethod = null,
        public readonly ?bool $isDefault = null,
        public readonly ?bool $isRestOfWorld = null,
        public readonly ?int $stateRulesCount = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly mixed $lastUpdatedBy = null,
        #[ListOf(CountryTaxStateRule::class)]
        public readonly ?array $stateRules = null,
    ) {
    }
}
