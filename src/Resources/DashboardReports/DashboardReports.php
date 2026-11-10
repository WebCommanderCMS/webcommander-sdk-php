<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\DashboardReports\DashboardReportsDto\QuickReport;
use WebCommander\Resources\DashboardReports\DashboardReportsDto\SalesReport;
use WebCommander\Resources\DashboardReports\DashboardReportsDto\SummaryReport;

/** Dashboard report endpoints, under `/api/{api_version}/admin/dashboard/reports`. Every report takes the same period query: `duration` (`today`, `yesterday`, `last_24_hours`, `last_7_days`, `last_30_days`, `this_month`, `last_month`, `last_3_months`, `last_6_months`, `last_12_months`, `last_24_months`, `last_36_months`, `last_48_months`, `last_60_months` or `custom`; `last_30_days` when left out) or `start_date` with `end_date` (`YYYY-MM-DD`, sent together, not reversed and not in the future). A bad value, a repeated `duration` and a lone date are `400` with every bad field listed; a name the report does not know is ignored. */
final class DashboardReports
{
    /** Read the quick report - `GET /admin/dashboard/reports/quick`: `period`, `kpis`, grouped totals, the most viewed pages under `view_report` and `trends`. `kpis` is a comma list of metric keys (an unknown one is `400`) that narrows `kpis` to those, in that order; `entity_name` is `page` (the default) or `product` and picks what `view_report` ranks.
     *  @param array<string,mixed>|null $queryParams */
    public static function getDashboardReportQuick(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardReportsUrls::DASHBOARD_REPORT_QUICK, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: QuickReport::class);
    }

    /** Ask whether the quick report is reachable - `HEAD /admin/dashboard/reports/quick`; the status of the read, with no body. It runs the read's query, so a bad value is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function headDashboardReportQuick(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', DashboardReportsUrls::DASHBOARD_REPORT_QUICK, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Read the sales report - `GET /admin/dashboard/reports/sales`: `rows` by day or month and `totals`. `breakdown` (`true` or `false`) adds orders, shipping, tax, discount, refunds and the top product to each row and total; `sort` is `date` (the default) or `sales` and `order` is `asc` (the default) or `desc`; any other value is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getDashboardReportSales(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardReportsUrls::DASHBOARD_REPORT_SALES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SalesReport::class);
    }

    /** Ask whether the sales report is reachable - `HEAD /admin/dashboard/reports/sales`; the status of the read, with no body. It runs the read's query, so a bad value is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function headDashboardReportSales(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', DashboardReportsUrls::DASHBOARD_REPORT_SALES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Read the summary - `GET /admin/dashboard/reports/summary`: the quick report without `kpis`, orders by month, sales rows, the most visited and best selling products and the order updates, in one answer. `compare_previous` (`true` or `false`) is checked as a boolean; any other value is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getDashboardReportSummary(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardReportsUrls::DASHBOARD_REPORT_SUMMARY, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SummaryReport::class);
    }

    /** Ask whether the summary is reachable - `HEAD /admin/dashboard/reports/summary`; the status of the read, with no body. It runs the read's query, so a bad value is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function headDashboardReportSummary(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', DashboardReportsUrls::DASHBOARD_REPORT_SUMMARY, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
