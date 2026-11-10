<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The Facebook Pixel on the product page. */
final class ProductSeoFacebookPixel extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $pixelId = null,
        public readonly ?ProductSeoFacebookPixelEvents $events = null,
    ) {
    }
}
