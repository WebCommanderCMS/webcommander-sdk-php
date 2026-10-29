<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `image_and_video` section: one field of its own beside two blocks. */
final class ImageAndVideo extends Dto
{
    public const ENVELOPE_KEY = 'image_and_video';

    public function __construct(
        public readonly ?bool $allowSingleFileUploadPerProduct = null,
        public readonly ?ImageDisplay $imageDisplay = null,
        public readonly ?ProductVideo $video = null,
    ) {
    }
}
