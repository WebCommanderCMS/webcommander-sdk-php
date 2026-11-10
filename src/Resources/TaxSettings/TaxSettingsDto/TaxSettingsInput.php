<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings\TaxSettingsDto;

use WebCommander\Client\Dto;

/** The body `PUT` and `PATCH` take, wrapped in `tax_settings`; both merge. The profile is written as `custom_tax_profile_id`; `calculated_by` is read-only. */
final class TaxSettingsInput extends Dto
{
    public const ENVELOPE_KEY = 'tax_settings';

    public function __construct(
        public readonly ?string $taxRateForCustomers = null,
        public readonly ?TaxRegionInput $taxRegion = null,
        public readonly ?int $customTaxProfileId = null,
        public readonly ?bool $isPriceShownWithTax = null,
        public readonly ?string $pricesInCatalog = null,
        public readonly ?bool $isOutOfRegionTaxFree = null,
        public readonly ?string $taxMessage = null,
        public readonly ?string $basePriceRounding = null,
    ) {
    }
}
