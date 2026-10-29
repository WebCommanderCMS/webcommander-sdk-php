<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One entry of a custom profile's `rules`, sent only by the row path. */
final class CustomProfileRule extends Dto
{
    /** @param list<CustomProfileReference|null>|null $profiles */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?int $zonesCount = null,
        #[ListOf(CustomProfileReference::class)]
        public readonly ?array $profiles = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
    ) {
    }
}
