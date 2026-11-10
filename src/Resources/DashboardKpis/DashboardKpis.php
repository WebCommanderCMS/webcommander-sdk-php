<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardKpis;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\DashboardKpis\DashboardKpisDto\KpiOptions;
use WebCommander\Resources\DashboardKpis\DashboardKpisDto\KpiSelection;

/** Dashboard KPI endpoints, under `/api/{api_version}/admin/dashboard`. */
final class DashboardKpis
{
    /** List the metrics a tile can show - `GET /admin/dashboard/kpi_options`, grouped, with `min` 2 and `max` 5 tiles and the keys now in use under `selected`. It reads the same tiles as `kpi_selection`. */
    public static function getDashboardKpiOptions(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardKpisUrls::DASHBOARD_KPI_OPTIONS, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: KpiOptions::class);
    }

    /** Read the tiles in use with their figures - `GET /admin/dashboard/kpi_selection`, the tiles of the default layout under `selected` in position order. `duration` (`last_30_days` when left out) or `start_date` with `end_date` (`YYYY-MM-DD`, sent together) choose the period; a bad value is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getDashboardKpiSelection(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardKpisUrls::DASHBOARD_KPI_SELECTION, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: KpiSelection::class);
    }

    /** Save the tiles - `PUT /admin/dashboard/kpi_selection` with `{"metrics": [...]}`, answered `200` like the read. The list replaces the default layout's tiles, which is store-wide state, and is read back at once by that layout and by `kpi_options`. Fewer than 2 or more than 5, a repeat, an unknown key, a missing `metrics` and a non-list are `400`. `duration` or the dates in the query set the period of the figures in the answer.
     *  @param array<string,mixed>|string|Dto $payload
     *  @param array<string,mixed>|null $queryParams */
    public static function updateDashboardKpiSelection(WebCommanderClient $client, array|string|Dto $payload, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(DashboardKpisUrls::DASHBOARD_KPI_SELECTION, queryParams: $queryParams, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: KpiSelection::class);
    }
}
