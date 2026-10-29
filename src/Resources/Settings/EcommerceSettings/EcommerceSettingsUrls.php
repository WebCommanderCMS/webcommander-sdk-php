<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings;

final class EcommerceSettingsUrls
{
    public const ECOMMERCE_SETTINGS = '/api/{api_version}/admin/settings/ecommerce_settings';
    public const ECOMMERCE_SETTINGS_SECTION = '/api/{api_version}/admin/settings/ecommerce_settings/{section}';

    /** The six values `{section}` takes; all six are writable.
     *  @var list<string> */
    public const ECOMMERCE_SETTINGS_SECTIONS = [
        'continue_shopping',
        'product_inventory',
        'pricing',
        'product_restriction',
        'order_filters',
        'location_settings',
    ];

    /** The one area key that is no section: a top-level collection's rows, inlined read-only. */
    public const ECOMMERCE_SETTINGS_COLLECTION_KEY = 'order_flags';
}
