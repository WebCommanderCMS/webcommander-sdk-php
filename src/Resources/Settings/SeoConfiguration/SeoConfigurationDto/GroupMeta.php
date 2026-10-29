<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section or collection. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $globalStoreSettings = null,
        public readonly ?SectionMeta $customCode = null,
        public readonly ?SectionMeta $documentRoot = null,
        public readonly ?SectionMeta $urlSettings = null,
    ) {
    }
}
