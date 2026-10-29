<?php

declare(strict_types=1);

namespace WebCommander\Resources\Cities\CitiesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the city listing. */
final class CityPage extends Dto
{
    /** @param list<City|null>|null $cities */
    public function __construct(
        #[ListOf(City::class)]
        public readonly ?array $cities = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
