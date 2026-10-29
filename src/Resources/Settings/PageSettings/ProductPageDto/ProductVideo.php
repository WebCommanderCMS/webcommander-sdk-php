<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `video` block: whether a product video is previewed, and where its thumbnail sits. */
final class ProductVideo extends Dto
{
    public function __construct(
        public readonly ?bool $enableVideoPreview = null,
        public readonly ?bool $displayVideoThumbnailInFirstOrder = null,
    ) {
    }
}
