<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The read-only uploaded loader that goes with `enable_custom_preloader`. */
final class CustomLoader extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $fileName = null,
        public readonly ?string $fileUrl = null,
    ) {
    }
}
