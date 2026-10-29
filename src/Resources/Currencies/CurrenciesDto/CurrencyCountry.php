<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies\CurrenciesDto;

use WebCommander\Client\Dto;

/** The country a currency is filed under, as every row answers it. */
final class CurrencyCountry extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
    ) {
    }
}
