<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $administration = null,
        public readonly ?SectionMeta $brandKit = null,
        public readonly ?SectionMeta $dateTime = null,
        public readonly ?SectionMeta $domainSettings = null,
        public readonly ?SectionMeta $emailSettings = null,
        public readonly ?SectionMeta $favicon = null,
        public readonly ?SectionMeta $storeDetails = null,
        public readonly ?SectionMeta $storeLogo = null,
    ) {
    }
}
