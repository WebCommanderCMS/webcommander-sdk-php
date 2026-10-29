<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

final class CategoryPageUrls
{
    public const CATEGORY_PAGE = '/api/{api_version}/admin/settings/page_settings/category_page';
    public const CATEGORY_PAGE_SECTION = '/api/{api_version}/admin/settings/page_settings/category_page/{section}';

    /** The two values `{section}` takes; both are writable.
     *  @var list<string> */
    public const CATEGORY_PAGE_SECTIONS = ['category_information', 'product_information'];
}
