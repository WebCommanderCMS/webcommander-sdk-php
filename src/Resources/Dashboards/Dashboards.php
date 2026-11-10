<?php

declare(strict_types=1);

namespace WebCommander\Resources\Dashboards;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Dashboards\DashboardsDto\Dashboard;
use WebCommander\Resources\Dashboards\DashboardsDto\DashboardListing;

/** Dashboard layout endpoints, under `/api/{api_version}/admin`. */
final class Dashboards
{
    /** List the admin's layouts - `GET /admin/dashboards`, `{"dashboards": [...]}` with no paging. Each row is `id`, `name`, `default` and the two timestamps, and exactly one row is the default. The store ignores any query. */
    public static function listDashboards(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardsUrls::DASHBOARDS, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DashboardListing::class);
    }

    /** Create a layout - `POST /admin/dashboards`, answered `201` with the whole layout, bare and with no `Location`. The body is bare and needs `name`, unique among the admin's layouts (`409` `name_taken`); an empty body is `400`. It starts as a copy of the layout named in `copy_from` or of the default one, then the sections and `kpis` sent are applied. Unknown fields are ignored.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createDashboard(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(DashboardsUrls::DASHBOARDS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Dashboard::class);
    }

    /** Read one layout by its `id` - `GET /admin/dashboards/{dashboard_id}`, the layout bare. An unknown id is `404` `not_found` on `dashboard_id`. */
    public static function getDashboard(WebCommanderClient $client, string $dashboardId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardsUrls::DASHBOARD, pathParams: ['dashboard_id' => $dashboardId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Dashboard::class);
    }

    /** Change only the fields sent - `PATCH /admin/dashboards/{dashboard_id}`, answered `200` with the whole layout. An empty body is `400`; unknown fields are ignored. A blank `name` or one over 60 characters is `400`, a section key the layout does not have is `400`, a standard section with a `position` is `400` and hiding `contact` is `400`. `default` `true` moves the store's default layout to this one.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchDashboard(WebCommanderClient $client, string $dashboardId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(DashboardsUrls::DASHBOARD, pathParams: ['dashboard_id' => $dashboardId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Dashboard::class);
    }

    /** Delete one layout - `DELETE /admin/dashboards/{dashboard_id}`, `204` with no body; the layout then reads `404`. */
    public static function deleteDashboard(WebCommanderClient $client, string $dashboardId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(DashboardsUrls::DASHBOARD, pathParams: ['dashboard_id' => $dashboardId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
