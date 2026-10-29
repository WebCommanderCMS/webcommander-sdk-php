<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxProfiles\TaxProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One tax profile; `$default` is exclusive and moves, taking `default_tax_profile` with it. A new
 *  profile's `$taxRules` is empty. */
final class TaxProfile extends Dto
{
    public const ENVELOPE_KEY = 'tax_profile';

    /** @param list<TaxProfileRule|null>|null $taxRules */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?bool $default = null,
        #[ListOf(TaxProfileRule::class)]
        public readonly ?array $taxRules = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
