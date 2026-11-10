<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections;

final class DashboardSectionsUrls
{
    public const DASHBOARD_SECTION = '/api/{api_version}/admin/dashboard/sections/{section}';

    /** The five `{section}` path values, the tabs of the Dashboard's `section_tabs` section. */
    public const DASHBOARD_SECTIONS = ['ecommerce', 'content', 'bookings', 'courses', 'blog'];
}
