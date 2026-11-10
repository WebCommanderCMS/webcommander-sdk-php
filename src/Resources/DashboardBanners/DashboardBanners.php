<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\DashboardBanners\DashboardBannersDto\DashboardBanner;
use WebCommander\Resources\DashboardBanners\DashboardBannersDto\DashboardBannerListing;
use WebCommander\Resources\DashboardBanners\DashboardBannersDto\DashboardContentInfo;

/** Dashboard banner endpoints, under `/api/{api_version}/admin/dashboard`. */
final class DashboardBanners
{
    /** List every banner, active or not - `GET /admin/dashboard/banners`, `{"banners": [...]}` in position order, positions counting from 1 without a gap. */
    public static function listDashboardBanners(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardBannersUrls::DASHBOARD_BANNERS, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DashboardBannerListing::class);
    }

    /** Create a banner - `POST /admin/dashboard/banners`, answered `201` with the banner bare and no `Location`. The body is bare; every failing field is listed in one `400`, a `key` already used is `400` `duplicate`, an unknown field is `400`. It joins the Dashboard feed at once while `active`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createDashboardBanner(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(DashboardBannersUrls::DASHBOARD_BANNERS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DashboardBanner::class);
    }

    /** Read one banner by its `key` - `GET /admin/dashboard/banners/{banner_key}`, the banner bare, hidden ones included. An unknown key is `404`. */
    public static function getDashboardBanner(WebCommanderClient $client, string $bannerKey, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardBannersUrls::DASHBOARD_BANNER, pathParams: ['banner_key' => $bannerKey], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DashboardBanner::class);
    }

    /** Change only the fields sent - `PATCH /admin/dashboard/banners/{banner_key}`, answered `200` with the banner. An empty body, a blank `title`, a `key` and an unknown field are `400`; an unknown banner is `404`. `learn_more` and `try_it` are replaced whole, and a `try_it` of null removes the second button. `updated_at` is not moved.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchDashboardBanner(WebCommanderClient $client, string $bannerKey, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(DashboardBannersUrls::DASHBOARD_BANNER, pathParams: ['banner_key' => $bannerKey], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DashboardBanner::class);
    }

    /** Delete one banner - `DELETE /admin/dashboard/banners/{banner_key}`, `204` with no body. The banners after it move up, so the positions stay without a gap; an unknown key is `404`. */
    public static function deleteDashboardBanner(WebCommanderClient $client, string $bannerKey, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(DashboardBannersUrls::DASHBOARD_BANNER, pathParams: ['banner_key' => $bannerKey], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Read what the Dashboard shows besides the figures - `GET /admin/dashboard/content_info`: the active banners under `banners`, the support card under `contact`, `online_store` and `member_label`. A hidden banner is not listed. */
    public static function getDashboardContentInfo(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DashboardBannersUrls::DASHBOARD_CONTENT_INFO, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DashboardContentInfo::class);
    }
}
