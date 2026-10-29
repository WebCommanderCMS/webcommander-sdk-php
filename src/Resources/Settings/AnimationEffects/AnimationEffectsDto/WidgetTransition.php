<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The `widget_transition` section: whether widgets fade in, and over how long. */
final class WidgetTransition extends Dto
{
    public const ENVELOPE_KEY = 'widget_transition';

    public function __construct(
        public readonly ?bool $widgetSmoothRender = null,
        public readonly ?int $widgetSmoothRenderDuration = null,
    ) {
    }
}
