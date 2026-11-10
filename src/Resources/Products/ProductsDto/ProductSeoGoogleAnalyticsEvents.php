<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Which Google Analytics events the product page sends. */
final class ProductSeoGoogleAnalyticsEvents extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $viewItem = null,
        public readonly ?bool $viewItemList = null,
        public readonly ?bool $viewCart = null,
        public readonly ?bool $addToWishList = null,
        public readonly ?bool $removeFromCart = null,
        public readonly ?bool $beginCheckout = null,
        public readonly ?bool $addShippingInfo = null,
        public readonly ?bool $addPaymentInfo = null,
        public readonly ?bool $purchase = null,
    ) {
    }
}
