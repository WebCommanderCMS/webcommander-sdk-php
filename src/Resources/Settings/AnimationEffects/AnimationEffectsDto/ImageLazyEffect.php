<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto;

use WebCommander\Client\Dto;

/** The `image_lazy_effect` section: which pages lazy-load images, and what shows meanwhile. */
final class ImageLazyEffect extends Dto
{
    public const ENVELOPE_KEY = 'image_lazy_effect';

    public function __construct(
        public readonly ?string $preloaderImageLazyEffectPreset = null,
        public readonly ?bool $productDetailsPageImageLazyEffect = null,
        public readonly ?bool $flyingCartImageLazyEffect = null,
        public readonly ?bool $productListImageLazyEffect = null,
        public readonly ?bool $propertyListImageLazyEffect = null,
        public readonly ?bool $propertyDetailsPageImageLazyEffect = null,
        public readonly ?bool $blogListImageLazyEffect = null,
        public readonly ?bool $blogDetailsPageImageLazyEffect = null,
        public readonly ?int $lazyLoaderSize = null,
        public readonly ?string $backgroundLazyLoader = null,
        public readonly ?string $contentImageLazyLoadBackground = null,
    ) {
    }
}
