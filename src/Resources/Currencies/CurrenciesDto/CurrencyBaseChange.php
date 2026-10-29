<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies\CurrenciesDto;

use WebCommander\Client\Dto;

/** The base write's body: the new base, and the row that held the flag or null. */
final class CurrencyBaseChange extends Dto
{
    public function __construct(
        public readonly ?Currency $currency = null,
        public readonly ?CurrencyReference $previousBase = null,
    ) {
    }
}
