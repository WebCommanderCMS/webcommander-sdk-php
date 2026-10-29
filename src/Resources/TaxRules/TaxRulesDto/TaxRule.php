<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxRules\TaxRulesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One tax rule; `$code`, `$zones`, `$decimalPoint` and `$roundingType` are read-only. */
final class TaxRule extends Dto
{
    public const ENVELOPE_KEY = 'tax_rule';

    /** @param list<TaxRuleZone|null>|null $zones */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?TaxRuleCode $code = null,
        public readonly ?string $description = null,
        public readonly ?bool $default = null,
        public readonly ?string $roundingType = null,
        public readonly ?int $decimalPoint = null,
        #[ListOf(TaxRuleZone::class)]
        public readonly ?array $zones = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
