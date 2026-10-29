<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The `page_skeleton` section, this area's one-field section. */
final class PageSkeleton extends Dto
{
    public const ENVELOPE_KEY = 'page_skeleton';

    public function __construct(
        public readonly ?bool $checkoutPageSkeleton = null,
    ) {
    }
}
