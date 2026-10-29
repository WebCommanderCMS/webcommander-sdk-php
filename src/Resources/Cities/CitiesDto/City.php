<?php

declare(strict_types=1);

namespace WebCommander\Resources\Cities\CitiesDto;

use WebCommander\Client\Dto;

/** One listing row. */
final class City extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $postCode = null,
        public readonly ?CityState $state = null,
        public readonly ?CityCountry $country = null,
    ) {
    }
}
