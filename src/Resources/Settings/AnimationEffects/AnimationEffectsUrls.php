<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects;

final class AnimationEffectsUrls
{
    public const ANIMATION_EFFECTS = '/api/{api_version}/admin/settings/animation_effects';
    public const ANIMATION_EFFECTS_SECTION = '/api/{api_version}/admin/settings/animation_effects/{section}';

    /** The five values `{section}` takes, in the order the facade sends them; all five are writable.
     *  @var list<string> */
    public const ANIMATION_EFFECTS_SECTIONS = [
        'preloader_design',
        'widget_transition',
        'page_transition',
        'image_lazy_effect',
        'page_skeleton',
    ];
}
