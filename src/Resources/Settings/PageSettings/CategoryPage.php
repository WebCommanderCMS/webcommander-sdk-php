<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\PageSettings\CategoryPageDto\CategoryPage as CategoryPageBody;

/** Category page settings: a facade over two sections, with no `PUT`, under
 *  `/api/{api_version}/admin/settings/page_settings/category_page`. */
final class CategoryPage
{
    /** Retrieve the area - `GET /admin/settings/page_settings/category_page`, both sections and
     *  `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCategoryPage(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CategoryPageUrls::CATEGORY_PAGE, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CategoryPageBody::class);
    }

    /** Update the area - `PATCH /admin/settings/page_settings/category_page`, wrapped in
     *  `category_page`; partial at every level.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCategoryPage(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CategoryPageUrls::CATEGORY_PAGE, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CategoryPageBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/page_settings/category_page`; `200` with no
     *  body and an `ETag`. */
    public static function headCategoryPage(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CategoryPageUrls::CATEGORY_PAGE, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/page_settings/category_page/{section}`, under the
     *  section's own key; `$section` is one of `CategoryPageUrls::CATEGORY_PAGE_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCategoryPageSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CategoryPageUrls::CATEGORY_PAGE_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CategoryPageBody::class);
    }

    /** Update one section - `PATCH /admin/settings/page_settings/category_page/{section}`, wrapped in
     *  the section's own key; only the fields being changed need appear.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCategoryPageSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CategoryPageUrls::CATEGORY_PAGE_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CategoryPageBody::class);
    }
}
