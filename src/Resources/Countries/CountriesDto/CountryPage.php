<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries\CountriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the country listing. */
final class CountryPage extends Dto
{
    /** @param list<Country|null>|null $countries */
    public function __construct(
        #[ListOf(Country::class)]
        public readonly ?array $countries = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
