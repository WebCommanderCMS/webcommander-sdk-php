<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings\TaxSettingsDto;

use WebCommander\Client\Dto;

/** The facade's nine flat keys; `$defaultTaxProfile` follows the `tax_profile` row holding `default`. */
final class TaxSettings extends Dto
{
    public const ENVELOPE_KEY = 'tax_settings';

    public function __construct(
        public readonly ?string $configurationType = null,
        public readonly ?bool $systemDefaultTax = null,
        public readonly ?string $defaultCountry = null,
        public readonly ?int $customTaxProfileId = null,
        public readonly ?int $defaultTaxProfile = null,
        public readonly ?bool $showPriceWithTax = null,
        public readonly ?bool $isPriceWithTax = null,
        public readonly ?string $defaultTaxCode = null,
        public readonly ?string $taxMessage = null,
    ) {
    }
}
