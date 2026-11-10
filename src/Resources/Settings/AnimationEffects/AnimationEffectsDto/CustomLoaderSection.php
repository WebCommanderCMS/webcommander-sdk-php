<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The `custom_loader` section: the uploaded preloader image, or `enabled: false`. */
final class CustomLoaderSection extends Dto
{
    public function __construct(
        public readonly ?CustomLoader $customLoader = null,
    ) {
    }
}
