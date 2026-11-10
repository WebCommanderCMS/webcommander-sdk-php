<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings\TaxSettingsDto;

use WebCommander\Client\Dto;

/** The nine keys under `tax_settings`, with `group_meta` and, when asked for, `field_metadata`. */
final class TaxSettings extends Dto
{
    public const ENVELOPE_KEY = 'tax_settings';

    public function __construct(
        public readonly ?string $taxRateForCustomers = null,
        public readonly ?TaxRegion $taxRegion = null,
        public readonly ?TaxProfileReference $customTaxProfile = null,
        public readonly ?bool $isPriceShownWithTax = null,
        public readonly ?string $pricesInCatalog = null,
        public readonly ?string $calculatedBy = null,
        public readonly ?bool $isOutOfRegionTaxFree = null,
        public readonly ?string $taxMessage = null,
        public readonly ?string $basePriceRounding = null,
        public readonly ?TaxSettingsGroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
