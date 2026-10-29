<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto\ReindexStatus;
use WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto\SearchSettings as SearchSettingsBody;

/** Search settings endpoints, under `/api/{api_version}/admin/settings/search_settings`, and the
 *  read-only `reindex_status`. Writing `synonyms` (`SearchSettingsUrls::SEARCH_SETTINGS_REINDEXING_SECTION`)
 *  starts a search reindex. */
final class SearchSettings
{
    /** Retrieve the area - `GET /admin/settings/search_settings`, all three sections and `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSearchSettings(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SearchSettingsUrls::SEARCH_SETTINGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchSettingsBody::class);
    }

    /** Update the area - `PATCH /admin/settings/search_settings`, wrapped in `search_settings` and
     *  nothing else; partial at every level, and one body may name several sections.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSearchSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SearchSettingsUrls::SEARCH_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchSettingsBody::class);
    }

    /** Replace the area - `PUT /admin/settings/search_settings`; whatever the body leaves out is
     *  reset, so prefer `patchSearchSettings()` unless replacement is meant.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function putSearchSettings(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(SearchSettingsUrls::SEARCH_SETTINGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchSettingsBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/search_settings`; `200` with no body. */
    public static function headSearchSettings(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SearchSettingsUrls::SEARCH_SETTINGS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/search_settings/{section}`, under the section's own
     *  key and with no `group_meta`; `$section` is one of `SearchSettingsUrls::SEARCH_SETTINGS_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSearchSettingsSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SearchSettingsUrls::SEARCH_SETTINGS_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchSettingsBody::class);
    }

    /** Update one section - `PATCH /admin/settings/search_settings/{section}`, wrapped in the
     *  section's own key; only the fields being changed need appear.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSearchSettingsSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SearchSettingsUrls::SEARCH_SETTINGS_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchSettingsBody::class);
    }

    /** Replace one section - `PUT /admin/settings/search_settings/{section}`, wrapped in the section's
     *  own key; a field left out is reset to its default, so send the whole section.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function putSearchSettingsSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(SearchSettingsUrls::SEARCH_SETTINGS_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchSettingsBody::class);
    }

    /** Read where the reindex stands - `GET /admin/settings/search_settings/reindex_status`, read-only.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSearchSettingsReindexStatus(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SearchSettingsUrls::SEARCH_SETTINGS_REINDEX_STATUS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ReindexStatus::class);
    }

    /** Ask whether the reindex status answers - `HEAD /admin/settings/search_settings/reindex_status`;
     *  `200` with no body and no `ETag`. */
    public static function headSearchSettingsReindexStatus(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SearchSettingsUrls::SEARCH_SETTINGS_REINDEX_STATUS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
