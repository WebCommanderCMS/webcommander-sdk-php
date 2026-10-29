<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $configuration = null,
        public readonly ?SectionMeta $variations = null,
        public readonly ?SectionMeta $imageAndVideo = null,
        public readonly ?SectionMeta $upSell = null,
        public readonly ?SectionMeta $relatedProducts = null,
        public readonly ?SectionMeta $reviewAndRatings = null,
        public readonly ?SectionMeta $quickView = null,
    ) {
    }
}
