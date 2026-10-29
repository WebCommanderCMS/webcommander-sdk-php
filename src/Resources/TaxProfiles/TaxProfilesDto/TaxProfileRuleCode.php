<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxProfiles\TaxProfilesDto;

use WebCommander\Client\Dto;

/** The tax code a nested rule points at. */
final class TaxProfileRuleCode extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $isDefault = null,
    ) {
    }
}
