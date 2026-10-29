<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxRules\TaxRulesDto;

use WebCommander\Client\Dto;

/** The tax code a rule points at; `{}` on a rule the store did not build. */
final class TaxRuleCode extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $isDefault = null,
    ) {
    }
}
