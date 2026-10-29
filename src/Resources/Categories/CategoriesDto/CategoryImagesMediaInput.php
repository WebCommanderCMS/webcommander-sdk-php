<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The writable `images_media` fields; each image reads back as its `*_url`, and neither a null
 *  nor an empty string removes a stored image. */
final class CategoryImagesMediaInput extends Dto
{
    public function __construct(
        public readonly ?CategoryImage $image = null,
        public readonly ?string $imageAlt = null,
        public readonly ?CategoryImage $backgroundImage = null,
    ) {
    }
}
