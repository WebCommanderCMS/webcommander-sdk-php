<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxRules\TaxRulesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. */
final class TaxRulePage extends Dto
{
    /** @param list<TaxRule|null>|null $taxRules */
    public function __construct(
        #[ListOf(TaxRule::class)]
        public readonly ?array $taxRules = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
