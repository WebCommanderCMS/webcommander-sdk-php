<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `preloader_design` section. Both `depends_on` rules are enforced: a `custom` page needs a
 *  `preloader_custom_page`, and `x_seconds` bounds `preloader_hide_after_time`. */
final class PreloaderDesign extends Dto
{
    public const ENVELOPE_KEY = 'preloader_design';

    /** @param list<PreloaderPage|null>|null $preloaderCustomPage */
    public function __construct(
        public readonly ?bool $enablePreloader = null,
        public readonly ?bool $enableCustomPreloader = null,
        public readonly ?string $preloaderPreset = null,
        public readonly ?int $preloaderSize = null,
        public readonly ?float $preloaderBackgroundOpacity = null,
        public readonly ?string $backgroundPreloader = null,
        public readonly ?string $preloaderHideCondition = null,
        public readonly ?string $preloaderShowTimeCondition = null,
        public readonly ?float $preloaderHideAfterTime = null,
        public readonly ?string $preloaderPage = null,
        #[ListOf(PreloaderPage::class)]
        public readonly ?array $preloaderCustomPage = null,
        public readonly ?CustomLoader $customLoader = null,
    ) {
    }
}
