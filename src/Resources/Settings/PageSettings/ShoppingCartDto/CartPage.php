<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ShoppingCartDto;

use WebCommander\Client\Dto;

/** The `cart_page` section: what the cart page offers a shopper. */
final class CartPage extends Dto
{
    public const ENVELOPE_KEY = 'cart_page';

    public function __construct(
        public readonly ?bool $showProductThumbnail = null,
        public readonly ?bool $enableClearCart = null,
        public readonly ?bool $saveCart = null,
    ) {
    }
}
