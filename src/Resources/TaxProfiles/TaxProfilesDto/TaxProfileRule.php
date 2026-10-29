<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxProfiles\TaxProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One tax rule as a profile nests it, the same ten keys a `/admin/tax_rules` read sends. */
final class TaxProfileRule extends Dto
{
    /** @param list<TaxProfileRuleZone|null>|null $zones */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?TaxProfileRuleCode $code = null,
        public readonly ?string $description = null,
        public readonly ?bool $default = null,
        public readonly ?string $roundingType = null,
        public readonly ?int $decimalPoint = null,
        #[ListOf(TaxProfileRuleZone::class)]
        public readonly ?array $zones = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
