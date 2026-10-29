<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings;

final class PriceDisplaySettingsUrls
{
    public const PRICE_DISPLAY_SETTINGS = '/api/{api_version}/admin/settings/price_display_settings';
    public const PRICE_DISPLAY_SETTINGS_SECTION = '/api/{api_version}/admin/settings/price_display_settings/{section}';

    /** The two values `{section}` takes, in the order the facade declares them; both are writable.
     *  @var list<string> */
    public const PRICE_DISPLAY_SETTINGS_SECTIONS = ['order_item', 'order_summary'];
}
