<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto\SiteSettings as SiteSettingsBody;

/** Site settings endpoints, under `/api/{api_version}/admin/settings/site_settings`: a facade over
 *  eight sections, with no `PUT`. */
final class SiteSettings
{
    /** Retrieve the area - `GET /admin/settings/site_settings`, all eight sections and `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSiteSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SiteSettingsUrls::SITE_SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SiteSettingsBody::class);
    }

    /** Update the area - `PATCH /admin/settings/site_settings`, wrapped in `site_settings` or bare;
     *  partial at every level. A key whose value is not a record is ignored, not refused.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSiteSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SiteSettingsUrls::SITE_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SiteSettingsBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/site_settings`; `200` with no body. */
    public static function headSiteSettings(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SiteSettingsUrls::SITE_SETTINGS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/site_settings/{section}`, under the section's own
     *  key; `$section` is one of `SiteSettingsUrls::SITE_SETTINGS_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSiteSettingsSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SiteSettingsUrls::SITE_SETTINGS_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SiteSettingsBody::class);
    }

    /** Update one section - `PATCH /admin/settings/site_settings/{section}`, one of
     *  `SiteSettingsUrls::SITE_SETTINGS_WRITABLE_SECTIONS`; secrets read back as `***`, so never echo a read.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSiteSettingsSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SiteSettingsUrls::SITE_SETTINGS_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SiteSettingsBody::class);
    }
}
