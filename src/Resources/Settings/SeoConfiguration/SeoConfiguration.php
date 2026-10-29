<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Resources\Customers\AdminCustomersDto\Page;
use WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto\DocumentRootFile;
use WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto\Redirect;
use WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto\SeoConfiguration as SeoConfigurationBody;

/** SEO configuration endpoints, under `/api/{api_version}/admin/settings/seo_configuration`: a
 *  facade over three sections and two collections, `document_root` and `redirects`. */
final class SeoConfiguration
{
    /** Retrieve the area - `GET /admin/settings/seo_configuration`, the sections and `group_meta`, with
     *  the collections inlined without their `pagination`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSeoConfiguration(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SeoConfigurationUrls::SEO_CONFIGURATION, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SeoConfigurationBody::class);
    }

    /** Update the area - `PATCH /admin/settings/seo_configuration`, wrapped in `seo_configuration`;
     *  partial at both levels.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSeoConfiguration(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SeoConfigurationUrls::SEO_CONFIGURATION, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SeoConfigurationBody::class);
    }

    /** Replace the named sections - `PUT /admin/settings/seo_configuration`; an omitted section is kept,
     *  but a named section's omitted fields reset, so send each named section whole.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function putSeoConfiguration(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(SeoConfigurationUrls::SEO_CONFIGURATION, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SeoConfigurationBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/seo_configuration`; `200` with no body and
     *  the `ETag` a `GET` carries. */
    public static function headSeoConfiguration(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SeoConfigurationUrls::SEO_CONFIGURATION, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/seo_configuration/{section}`, under the section's own
     *  key; `$section` is one of `SeoConfigurationUrls::SEO_CONFIGURATION_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSeoConfigurationSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SeoConfigurationUrls::SEO_CONFIGURATION_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SeoConfigurationBody::class);
    }

    /** Update one section - `PATCH /admin/settings/seo_configuration/{section}`, wrapped in the
     *  section's own key; only the fields being changed need appear.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSeoConfigurationSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SeoConfigurationUrls::SEO_CONFIGURATION_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SeoConfigurationBody::class);
    }

    /** Replace one section - `PUT /admin/settings/seo_configuration/{section}`, wrapped in the section's
     *  own key; an omitted field resets to its default, so send the section back whole.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function putSeoConfigurationSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(SeoConfigurationUrls::SEO_CONFIGURATION_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SeoConfigurationBody::class);
    }

    /** List the document-root files - `GET /admin/settings/seo_configuration/document_root`, rows under
     *  `items`; `limit` is capped at 100.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSeoConfigurationDocumentRoot(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SeoConfigurationUrls::SEO_CONFIGURATION_DOCUMENT_ROOT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::of(DocumentRootFile::class));
    }

    /** Ask whether the document-root listing answers -
     *  `HEAD /admin/settings/seo_configuration/document_root`; `200` with no body and no `ETag`. */
    public static function headSeoConfigurationDocumentRoot(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SeoConfigurationUrls::SEO_CONFIGURATION_DOCUMENT_ROOT, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Upload a document-root file - `POST /admin/settings/seo_configuration/document_root`, `201`; its
     *  `config_key` is the id the delete takes.
     *  @param mixed $files one part named exactly "file", as [filename, contents, contentType] */
    public static function uploadSeoConfigurationDocumentRoot(WebCommanderClient $client, mixed $files, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        self::requireFiles($files);
        return $client->sendPostRequest(SeoConfigurationUrls::SEO_CONFIGURATION_DOCUMENT_ROOT, files: $files, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DocumentRootFile::class);
    }

    /** Delete one document-root file - `DELETE /admin/settings/seo_configuration/document_root/{config_key}`,
     *  `204`; nothing puts it back. */
    public static function deleteSeoConfigurationDocumentRootFile(WebCommanderClient $client, string $configKey, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(SeoConfigurationUrls::SEO_CONFIGURATION_DOCUMENT_ROOT_FILE, pathParams: ['config_key' => $configKey], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** List the redirects - `GET /admin/settings/seo_configuration/redirects`, rows under `items`;
     *  `limit` is capped at 100.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSeoConfigurationRedirects(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SeoConfigurationUrls::SEO_CONFIGURATION_REDIRECTS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::of(Redirect::class));
    }

    /** Ask whether the redirects listing answers - `HEAD /admin/settings/seo_configuration/redirects`;
     *  `200` with no body and no `ETag`. */
    public static function headSeoConfigurationRedirects(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SeoConfigurationUrls::SEO_CONFIGURATION_REDIRECTS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a redirect - `POST /admin/settings/seo_configuration/redirects`, `201`, bare or wrapped in
     *  `redirect`; `source_url` and `destination_url` are both required.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createSeoConfigurationRedirect(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(SeoConfigurationUrls::SEO_CONFIGURATION_REDIRECTS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Redirect::class);
    }

    /** Retrieve one redirect - `GET /admin/settings/seo_configuration/redirects/{redirect_id}`, the row
     *  under `redirect`. */
    public static function getSeoConfigurationRedirect(WebCommanderClient $client, int|string $redirectId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SeoConfigurationUrls::SEO_CONFIGURATION_REDIRECT, pathParams: ['redirect_id' => $redirectId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Redirect::class);
    }

    /** Ask whether one redirect is there - `HEAD /admin/settings/seo_configuration/redirects/{redirect_id}`;
     *  no body, and `404` for an unknown id. */
    public static function headSeoConfigurationRedirect(WebCommanderClient $client, int|string $redirectId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SeoConfigurationUrls::SEO_CONFIGURATION_REDIRECT, pathParams: ['redirect_id' => $redirectId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Update one redirect - `PATCH /admin/settings/seo_configuration/redirects/{redirect_id}`, partial.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSeoConfigurationRedirect(WebCommanderClient $client, int|string $redirectId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SeoConfigurationUrls::SEO_CONFIGURATION_REDIRECT, pathParams: ['redirect_id' => $redirectId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Redirect::class);
    }

    /** Delete one redirect - `DELETE /admin/settings/seo_configuration/redirects/{redirect_id}`, `204`;
     *  the URL stops forwarding. */
    public static function deleteSeoConfigurationRedirect(WebCommanderClient $client, int|string $redirectId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(SeoConfigurationUrls::SEO_CONFIGURATION_REDIRECT, pathParams: ['redirect_id' => $redirectId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    private static function requireFiles(mixed $files): void
    {
        if (!is_array($files) || $files === []) {
            throw new SdkUsageError("files: pass ['file' => [filename, contents, contentType]]");
        }
    }
}
