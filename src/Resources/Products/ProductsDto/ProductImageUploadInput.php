<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The image upload's body, `{"product": {"image_and_video": {"images": [...]}}}`. */
final class ProductImageUploadInput extends Dto
{
    public const ENVELOPE_KEY = 'product';

    public function __construct(
        public readonly ?ProductImageAndVideoInput $imageAndVideo = null,
    ) {
    }
}
