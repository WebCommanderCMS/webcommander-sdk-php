<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** One entry of `preloader_custom_page` as read; a write takes page ids instead. */
final class PreloaderPage extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
