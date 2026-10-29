<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages;

final class PagesUrls
{
    public const PAGES = '/api/{api_version}/admin/pages';
    public const PAGES_COUNT = '/api/{api_version}/admin/pages/count';
    public const PAGE = '/api/{api_version}/admin/pages/{page_id}';
    public const PAGE_URL = '/api/{api_version}/admin/pages/{page_id}/url';
    public const PAGE_LANDING = '/api/{api_version}/admin/pages/{page_id}/landing';
    public const PAGE_DELETE_BLOCKERS = '/api/{api_version}/admin/pages/{page_id}/delete-blockers';
    public const PAGE_DUPLICATE = '/api/{api_version}/admin/pages/{page_id}/duplicate';

    /** Carries the `ETag` a read answered; a stale one makes the write `412`. */
    public const IF_MATCH_HEADER = 'If-Match';
}
