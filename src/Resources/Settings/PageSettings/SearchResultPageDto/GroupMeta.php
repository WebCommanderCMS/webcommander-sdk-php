<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section, collection or action. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $productInformation = null,
        public readonly ?SectionMeta $seo = null,
        public readonly ?SectionMeta $productPromotion = null,
        public readonly ?SectionMeta $reinitialise = null,
    ) {
    }
}
