<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `image_display` block: how product images are laid out and zoomed. */
final class ImageDisplay extends Dto
{
    public function __construct(
        public readonly ?bool $enableImageSlider = null,
        public readonly ?bool $productThumbnailVerticalView = null,
        public readonly ?bool $productImageView = null,
        public readonly ?string $productImageViewType = null,
        public readonly ?bool $imageZoomType = null,
        public readonly ?string $zoomType = null,
    ) {
    }
}
