<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class AnimationEffects extends Dto
{
    public const ENVELOPE_KEY = 'animation_effects';

    public function __construct(
        public readonly ?PreloaderDesign $preloaderDesign = null,
        public readonly ?WidgetTransition $widgetTransition = null,
        public readonly ?PageTransition $pageTransition = null,
        public readonly ?ImageLazyEffect $imageLazyEffect = null,
        public readonly ?PageSkeleton $pageSkeleton = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
