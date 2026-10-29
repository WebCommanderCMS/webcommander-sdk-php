<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCountryTaxes\TaxCountryTaxesDto;

use WebCommander\Client\Dto;

/** The body both writes take, wrapped in `country_tax`, `$countryCode` the create's one
 *  requirement. `$transactionNo` goes beside the wrapper, where the create files it. */
final class CountryTaxInput extends Dto
{
    public const ENVELOPE_KEY = 'country_tax';
    public const TOP_LEVEL = ['transaction_no'];

    public function __construct(
        public readonly ?string $countryCode = null,
        public readonly ?string $name = null,
        public readonly ?string $taxCode = null,
        public readonly ?float $taxRate = null,
        public readonly ?string $taxMethod = null,
        public readonly ?bool $isDefault = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
