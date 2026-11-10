<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings\TaxSettingsDto;

use WebCommander\Client\Dto;

/** `tax_region` as a write takes it: a `country_code` with an optional `state_code`, or a `country_tax_id`. */
final class TaxRegionInput extends Dto
{

    public function __construct(
        public readonly ?int $countryTaxId = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $stateCode = null,
    ) {
    }
}
