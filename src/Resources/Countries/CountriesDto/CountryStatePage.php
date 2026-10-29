<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries\CountriesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of a country's states, beside the short parent country. */
final class CountryStatePage extends Dto
{
    /** @param list<CountryState|null>|null $states */
    public function __construct(
        public readonly ?CountryReference $country = null,
        #[ListOf(CountryState::class)]
        public readonly ?array $states = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
