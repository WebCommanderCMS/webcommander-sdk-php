<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings;

final class SiteSettingsUrls
{
    public const SITE_SETTINGS = '/api/{api_version}/admin/settings/site_settings';
    public const SITE_SETTINGS_SECTION = '/api/{api_version}/admin/settings/site_settings/{section}';

    /** The eight values `{section}` takes, alphabetically; the facade's own key order is not stable.
     *  @var list<string> */
    public const SITE_SETTINGS_SECTIONS = [
        'administration',
        'brand_kit',
        'date_time',
        'domain_settings',
        'email_settings',
        'favicon',
        'store_details',
        'store_logo',
    ];

    /** Every section but the two image sections, `favicon` and `store_logo`, which take an
     *  `image_base64` upload or a `remove` flag.
     *  @var list<string> */
    public const SITE_SETTINGS_WRITABLE_SECTIONS = [
        'administration',
        'brand_kit',
        'date_time',
        'domain_settings',
        'email_settings',
        'store_details',
    ];
}
