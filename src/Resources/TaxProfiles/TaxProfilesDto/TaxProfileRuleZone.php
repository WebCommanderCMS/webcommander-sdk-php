<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxProfiles\TaxProfilesDto;

use WebCommander\Client\Dto;

/** One tax zone a nested rule points at. */
final class TaxProfileRuleZone extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $isSystemGenerated = null,
        public readonly ?bool $isDefault = null,
    ) {
    }
}
