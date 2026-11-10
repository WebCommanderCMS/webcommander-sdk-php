<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings\TaxSettingsDto;

use WebCommander\Client\Dto;

/** The country tax the store charges by default, as `tax_region` reads it. */
final class TaxRegion extends Dto
{

    public function __construct(
        public readonly ?int $countryTaxId = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $countryName = null,
    ) {
    }
}
