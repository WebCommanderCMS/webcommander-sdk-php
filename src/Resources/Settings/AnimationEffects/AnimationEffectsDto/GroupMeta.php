<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $preloaderDesign = null,
        public readonly ?SectionMeta $widgetTransition = null,
        public readonly ?SectionMeta $pageTransition = null,
        public readonly ?SectionMeta $imageLazyEffect = null,
        public readonly ?SectionMeta $pageSkeleton = null,
    ) {
    }
}
