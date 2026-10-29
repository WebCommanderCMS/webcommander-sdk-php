<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCountryTaxes\TaxCountryTaxesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, `group_meta` and the paging block. */
final class CountryTaxPage extends Dto
{
    /** @param list<CountryTax|null>|null $countryTaxes */
    public function __construct(
        #[ListOf(CountryTax::class)]
        public readonly ?array $countryTaxes = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
