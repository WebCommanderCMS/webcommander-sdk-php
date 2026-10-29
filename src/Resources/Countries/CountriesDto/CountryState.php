<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries\CountriesDto;

use WebCommander\Client\Dto;

/** One state: a listing row, and the state path's body with its parent `country` beside it. */
final class CountryState extends Dto
{
    public const ENVELOPE_KEY = 'state';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?bool $active = null,
        public readonly ?bool $default = null,
        public readonly ?CountryReference $country = null,
    ) {
    }
}
