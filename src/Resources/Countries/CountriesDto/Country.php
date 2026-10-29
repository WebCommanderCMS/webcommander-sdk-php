<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries\CountriesDto;

use WebCommander\Client\Dto;

/** One country: a listing row, and the row path's body. */
final class Country extends Dto
{
    public const ENVELOPE_KEY = 'country';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?int $stateCount = null,
        public readonly ?bool $active = null,
        public readonly ?bool $default = null,
    ) {
    }
}
