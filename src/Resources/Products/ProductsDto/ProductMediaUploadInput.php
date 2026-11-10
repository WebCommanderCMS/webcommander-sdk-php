<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The media upload's body, no envelope: `$type` (only `images` is accepted), `$filename` and
 *  `$content`, base64 or a `data:` URI, and an optional 1-based `$position`. */
final class ProductMediaUploadInput extends Dto
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $filename = null,
        public readonly ?string $content = null,
        public readonly ?int $position = null,
    ) {
    }
}
