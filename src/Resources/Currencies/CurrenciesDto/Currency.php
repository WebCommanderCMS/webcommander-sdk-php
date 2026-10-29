<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies\CurrenciesDto;

use WebCommander\Client\Dto;

/** One currency: a listing row, the row path's body and every row write's answer. The base write
 *  answers only `$id`, `$name`, `$code` and `$base` of it. */
final class Currency extends Dto
{
    public const ENVELOPE_KEY = 'currency';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $code = null,
        public readonly ?string $symbol = null,
        public readonly ?CurrencyCountry $country = null,
        public readonly ?float $conversionRate = null,
        public readonly ?string $rounding = null,
        public readonly ?int $precision = null,
        public readonly ?bool $active = null,
        public readonly ?bool $base = null,
        public readonly ?string $updatedAt = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
