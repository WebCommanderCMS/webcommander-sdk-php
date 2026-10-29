<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $searchableContent = null,
        public readonly ?SectionMeta $searchFields = null,
        public readonly ?SectionMeta $synonyms = null,
    ) {
    }
}
