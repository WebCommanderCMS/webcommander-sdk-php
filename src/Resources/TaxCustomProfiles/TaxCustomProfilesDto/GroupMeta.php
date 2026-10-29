<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto;

use WebCommander\Client\Dto;

/** The `group_meta` block only the listing sends. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?ResourceMeta $customProfile = null,
        public readonly ?ResourceMeta $rules = null,
    ) {
    }
}
