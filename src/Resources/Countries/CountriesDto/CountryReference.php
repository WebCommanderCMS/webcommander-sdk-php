<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries\CountriesDto;

use WebCommander\Client\Dto;

/** The short parent country a state listing and a state read carry beside the state. */
final class CountryReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
    ) {
    }
}
