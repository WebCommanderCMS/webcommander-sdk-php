<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxProfiles\TaxProfilesDto;

use WebCommander\Client\Dto;

/** The body both writes take; the update is a merge. `$default` is one-way: `false` leaves the
 *  flag on. */
final class TaxProfileInput extends Dto
{
    public const ENVELOPE_KEY = 'tax_profile';

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?bool $default = null,
    ) {
    }
}
