<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies\CurrenciesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, where they sit and any schema. */
final class CurrencyPage extends Dto
{
    /** @param list<Currency|null>|null $currencies */
    public function __construct(
        #[ListOf(Currency::class)]
        public readonly ?array $currencies = null,
        public readonly ?Pagination $pagination = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
