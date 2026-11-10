<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** One image to store: `$filename` and its `$base64` content. */
final class ProductImageFileInput extends Dto
{
    public function __construct(
        public readonly ?string $filename = null,
        #[WireName('base64')]
        public readonly ?string $base64 = null,
    ) {
    }
}
