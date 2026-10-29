<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The `images_media` section as read: the two stored images' URLs and the image's alt text,
 *  each `""` when unset. */
final class CategoryImagesMedia extends Dto
{
    public function __construct(
        public readonly ?string $imageUrl = null,
        public readonly ?string $imageAlt = null,
        public readonly ?string $backgroundImageUrl = null,
    ) {
    }
}
