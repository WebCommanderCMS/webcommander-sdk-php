<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

final class SearchResultPageUrls
{
    public const SEARCH_RESULT_PAGE = '/api/{api_version}/admin/settings/page_settings/search_result_page';
    public const SEARCH_RESULT_PAGE_SECTION = '/api/{api_version}/admin/settings/page_settings/search_result_page/{section}';
    public const SEARCH_RESULT_PAGE_PRODUCT_PROMOTIONS = '/api/{api_version}/admin/settings/page_settings/search_result_page/product_promotion';
    public const SEARCH_RESULT_PAGE_PRODUCT_PROMOTION = '/api/{api_version}/admin/settings/page_settings/search_result_page/product_promotion/{promotion_id}';
    public const SEARCH_RESULT_PAGE_PRODUCT_PROMOTION_ACTIVE = '/api/{api_version}/admin/settings/page_settings/search_result_page/product_promotion/{promotion_id}/active';

    /** The three values `{section}` takes; only `product_information` is writable.
     *  @var list<string> */
    public const SEARCH_RESULT_PAGE_SECTIONS = ['product_information', 'seo', 'reinitialise'];
}
