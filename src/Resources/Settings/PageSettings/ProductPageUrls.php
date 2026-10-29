<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

final class ProductPageUrls
{
    public const PRODUCT_PAGE = '/api/{api_version}/admin/settings/page_settings/product_page';
    public const PRODUCT_PAGE_SECTION = '/api/{api_version}/admin/settings/page_settings/product_page/{section}';

    /** The seven values `{section}` takes, in the order the facade declares them; all are writable.
     *  @var list<string> */
    public const PRODUCT_PAGE_SECTIONS = [
        'configuration',
        'variations',
        'image_and_video',
        'up_sell',
        'related_products',
        'review_and_ratings',
        'quick_view',
    ];
}
