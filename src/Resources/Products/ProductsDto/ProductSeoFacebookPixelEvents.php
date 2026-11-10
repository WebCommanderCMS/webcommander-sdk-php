<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Which Facebook Pixel events the product page sends. */
final class ProductSeoFacebookPixelEvents extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $search = null,
        public readonly ?bool $addToCart = null,
        public readonly ?bool $addToWishList = null,
        public readonly ?bool $initiateCheckout = null,
        public readonly ?bool $addPaymentInfo = null,
        public readonly ?bool $purchase = null,
    ) {
    }
}
