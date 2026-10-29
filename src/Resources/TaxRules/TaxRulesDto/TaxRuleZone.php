<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxRules\TaxRulesDto;

use WebCommander\Client\Dto;

/** One tax zone a rule points at, four of the zone's twelve keys. */
final class TaxRuleZone extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $isSystemGenerated = null,
        public readonly ?bool $isDefault = null,
    ) {
    }
}
