<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards;

final class DashboardsUrls
{
    public const DASHBOARDS = '/api/{api_version}/admin/dashboards';
    public const DASHBOARD = '/api/{api_version}/admin/dashboards/{dashboard_id}';
}
