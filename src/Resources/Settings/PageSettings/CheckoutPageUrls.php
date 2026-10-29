<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

final class CheckoutPageUrls
{
    public const CHECKOUT_PAGE = '/api/{api_version}/admin/settings/page_settings/checkout_page';
    public const CHECKOUT_PAGE_SECTION = '/api/{api_version}/admin/settings/page_settings/checkout_page/{section}';

    /** The six values `{section}` takes, in the order the facade declares them.
     *  @var list<string> */
    public const CHECKOUT_PAGE_SECTIONS = [
        'billing_address',
        'shipping_address',
        'customer_checkout',
        'delivery_options',
        'order_summary',
        'others',
    ];

    /** The four writable sections, the only ones a `PATCH` may name.
     *  @var list<string> */
    public const CHECKOUT_PAGE_WRITABLE_SECTIONS = [
        'customer_checkout',
        'delivery_options',
        'order_summary',
        'others',
    ];
}
