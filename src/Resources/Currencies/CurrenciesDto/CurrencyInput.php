<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies\CurrenciesDto;

use WebCommander\Client\Dto;

/** The writable fields, for the create, the `PUT` replace and the `PATCH`; no envelope.
 *  `$country` takes a country's id, code, name or `{"code": ...}`. */
final class CurrencyInput extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $code = null,
        public readonly ?string $symbol = null,
        public readonly int|string|CurrencyCountry|null $country = null,
        public readonly ?float $conversionRate = null,
        public readonly ?string $rounding = null,
        public readonly ?int $precision = null,
        public readonly ?bool $active = null,
    ) {
    }
}
