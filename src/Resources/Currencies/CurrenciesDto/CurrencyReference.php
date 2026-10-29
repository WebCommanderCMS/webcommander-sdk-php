<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies\CurrenciesDto;

use WebCommander\Client\Dto;

/** The row that held the base flag before a base write. */
final class CurrencyReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
    ) {
    }
}
