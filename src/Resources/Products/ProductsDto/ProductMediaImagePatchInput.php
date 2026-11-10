<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The image move body, no envelope: the 1-based `position`, the only field it takes. */
final class ProductMediaImagePatchInput extends Dto
{
    public function __construct(
        public readonly ?int $position = null,
    ) {
    }
}
