<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto;

use WebCommander\Client\Dto;

/** One profile a rule is filed under, on the rule's `profiles`. */
final class CustomProfileReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
