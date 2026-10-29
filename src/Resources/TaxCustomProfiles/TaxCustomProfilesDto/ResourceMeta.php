<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto;

use WebCommander\Client\Dto;

/** One `group_meta` entry: what the path is, whether it is writable and where. */
final class ResourceMeta extends Dto
{
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?bool $writable = null,
        public readonly ?string $href = null,
    ) {
    }
}
