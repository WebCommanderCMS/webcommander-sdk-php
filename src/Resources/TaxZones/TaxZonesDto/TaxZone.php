<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxZones\TaxZonesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One tax zone. `$postCode` reads as the flat list of strings a write sends, and
 *  `$systemGenerated` marks a row the store owns. */
final class TaxZone extends Dto
{
    public const ENVELOPE_KEY = 'tax_zone';

    /** @param list<TaxCountry|null>|null $countries
     *  @param list<TaxState|null>|null $states
     *  @param list<string>|null $postCode */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $systemGenerated = null,
        public readonly ?bool $default = null,
        public readonly ?bool $useRadius = null,
        public readonly ?float $radius = null,
        public readonly ?string $startLocation = null,
        #[ListOf(TaxCountry::class)]
        public readonly ?array $countries = null,
        #[ListOf(TaxState::class)]
        public readonly ?array $states = null,
        public readonly ?array $postCode = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
