<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One custom tax profile; the row path adds `$rules` to the eight keys a listing row, the create
 *  and the update answer carry. */
final class CustomProfile extends Dto
{
    public const ENVELOPE_KEY = 'custom_profile';

    /** @param list<CustomProfileRule|null>|null $rules */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $taxCode = null,
        public readonly ?string $description = null,
        public readonly ?bool $isDefault = null,
        public readonly ?int $rulesCount = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        #[ListOf(CustomProfileRule::class)]
        public readonly ?array $rules = null,
    ) {
    }
}
