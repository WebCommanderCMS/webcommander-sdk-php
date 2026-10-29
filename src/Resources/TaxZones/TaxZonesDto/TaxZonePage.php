<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxZones\TaxZonesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. */
final class TaxZonePage extends Dto
{
    /** @param list<TaxZone|null>|null $taxZones */
    public function __construct(
        #[ListOf(TaxZone::class)]
        public readonly ?array $taxZones = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
