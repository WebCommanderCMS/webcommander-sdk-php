<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies\CurrenciesDto;

use WebCommander\Client\Dto;

/** The count sub-path's body, a bare `{"total": N}`. */
final class CurrencyCount extends Dto
{
    public function __construct(
        public readonly ?int $total = null,
    ) {
    }
}
