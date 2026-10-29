<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCodes\TaxCodesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. */
final class TaxCodePage extends Dto
{
    /** @param list<TaxCode|null>|null $taxCodes */
    public function __construct(
        #[ListOf(TaxCode::class)]
        public readonly ?array $taxCodes = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
