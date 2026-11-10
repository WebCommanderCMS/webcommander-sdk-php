<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners;

final class DashboardBannersUrls
{
    public const DASHBOARD_BANNERS = '/api/{api_version}/admin/dashboard/banners';
    public const DASHBOARD_BANNER = '/api/{api_version}/admin/dashboard/banners/{banner_key}';
    public const DASHBOARD_CONTENT_INFO = '/api/{api_version}/admin/dashboard/content_info';
}
