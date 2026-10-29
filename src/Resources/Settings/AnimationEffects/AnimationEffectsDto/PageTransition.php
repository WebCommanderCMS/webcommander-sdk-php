<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The `page_transition` section: the animation between pages, and when it plays. */
final class PageTransition extends Dto
{
    public const ENVELOPE_KEY = 'page_transition';

    public function __construct(
        public readonly ?string $pageTransitionAnimationType = null,
        public readonly ?float $transitionAnimationDuration = null,
        public readonly ?bool $animationBeforeEnteringNewPage = null,
        public readonly ?bool $animationAfterEnteringNewPage = null,
    ) {
    }
}
