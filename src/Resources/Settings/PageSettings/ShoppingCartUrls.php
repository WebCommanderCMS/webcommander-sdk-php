<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

final class ShoppingCartUrls
{
    public const SHOPPING_CART = '/api/{api_version}/admin/settings/page_settings/shopping_cart';
    public const SHOPPING_CART_SECTION = '/api/{api_version}/admin/settings/page_settings/shopping_cart/{section}';

    /** The two values `{section}` takes; both are writable.
     *  @var list<string> */
    public const SHOPPING_CART_SECTIONS = ['cart_page', 'flying_cart'];
}
