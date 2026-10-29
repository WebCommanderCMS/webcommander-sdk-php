<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxZones\TaxZonesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The body both writes take, `$name` required by both. The update replaces the lists, so send
 *  every list that is to live; `$radius` and `$startLocation` are read only with `$useRadius` true. */
final class TaxZoneInput extends Dto
{
    public const ENVELOPE_KEY = 'tax_zone';

    /** @param list<TaxCountry>|null $countries
     *  @param list<TaxState>|null $states
     *  @param list<string>|null $postCode */
    public function __construct(
        public readonly ?string $name = null,
        #[ListOf(TaxCountry::class)]
        public readonly ?array $countries = null,
        #[ListOf(TaxState::class)]
        public readonly ?array $states = null,
        public readonly ?array $postCode = null,
        public readonly ?float $radius = null,
        public readonly ?string $startLocation = null,
        public readonly ?bool $useRadius = null,
    ) {
    }
}
