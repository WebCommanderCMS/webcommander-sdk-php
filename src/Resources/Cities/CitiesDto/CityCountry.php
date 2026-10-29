<?php

declare(strict_types=1);

namespace WebCommander\Resources\Cities\CitiesDto;

use WebCommander\Client\Dto;

/** The country a city row carries; `$id` is the one the `countries` listing answers. */
final class CityCountry extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
    ) {
    }
}
