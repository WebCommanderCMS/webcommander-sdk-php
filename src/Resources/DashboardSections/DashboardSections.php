<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\DashboardSections\DashboardSectionsDto\DashboardSectionReport;

/** Dashboard section endpoints, under `/api/{api_version}/admin/dashboard/sections`. The Dashboard shows five tabs; a tab is a path value. */
final class DashboardSections
{
    /** Read one tab - `GET /admin/dashboard/sections/{section}`, `$section` being one of `DashboardSectionsUrls::DASHBOARD_SECTIONS` (`ecommerce`, `content`, `bookings`, `courses`, `blog`); the answer is bare, `section` echoing it, with `period` and that tab's own fields. Any other value is `404` `not_found` on `key`. `duration` or `start_date` with `end_date` choose the period, as in the reports.
     *  @param array<string,mixed>|null $queryParams */
    public static function getDashboardSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardSectionsUrls::DASHBOARD_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DashboardSectionReport::class);
    }
}
