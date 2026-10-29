<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Categories\CategoriesDto\Category;
use WebCommander\Resources\Categories\CategoriesDto\CategoryCount;
use WebCommander\Resources\Categories\CategoriesDto\CategoryPage;

/** Category endpoints, under `/api/{api_version}/admin`. A row nests six sections, each also a
 *  `{section}` path value; every write is wrapped in `category`. */
final class Categories
{
    /** List the categories, newest update first - `GET /admin/categories`; `limit` caps at 20.
     *  `name`, `searchText` and `parent` filter, `sort` and `dir` order; unknown names are ignored.
     *  @param array<string,mixed>|null $queryParams */
    public static function listCategories(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CategoriesUrls::CATEGORIES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CategoryPage::class);
    }

    /** Count the categories - `GET /admin/categories/count`; the listing's `name`, `searchText` and
     *  `parent` narrow it, and trashed rows are not counted.
     *  @param array<string,mixed>|null $queryParams */
    public static function countCategories(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CategoriesUrls::CATEGORIES_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CategoryCount::class);
    }

    /** Ask whether a name is free - `GET /admin/categories/check-name`; read `available` off `->map`.
     *  Exact and case-insensitive over every level and the trash; a create refuses a top-level name. */
    public static function checkCategoryName(WebCommanderClient $client, string $name, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CategoriesUrls::CATEGORIES_CHECK_NAME, queryParams: ['name' => $name], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a category - `POST /admin/categories`, `201`. The body is wrapped in `category` and
     *  needs `general.name`; a top-level row's name, trash included, is `409`. `$transactionNo` is sent
     *  as `X-Transaction-No` and files the category under that number.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createCategory(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(CategoriesUrls::CATEGORIES, jsonBody: $payload, headers: $transactionNo === null ? null : [CategoriesUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Category::class);
    }

    /** Retrieve one category - `GET /admin/categories/{category_id}`; a trashed one still reads `200`
     *  with `in_trash: true`. `field_metadata` adds the field schema.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCategory(WebCommanderClient $client, int|string $categoryId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CategoriesUrls::CATEGORY, pathParams: ['category_id' => $categoryId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Category::class);
    }

    /** Replace one category - `PUT /admin/categories/{category_id}`; omitted fields reset, except `name`,
     *  `sku`, `url`, the images and `tax_shipping` other than its two profiles.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateCategory(WebCommanderClient $client, int|string $categoryId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(CategoriesUrls::CATEGORY, pathParams: ['category_id' => $categoryId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Category::class);
    }

    /** Merge fields into one category - `PATCH /admin/categories/{category_id}`, across as many
     *  sections as the body names; what it omits keeps its stored value.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCategory(WebCommanderClient $client, int|string $categoryId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CategoriesUrls::CATEGORY, pathParams: ['category_id' => $categoryId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Category::class);
    }

    /** Move one category to the trash - `DELETE /admin/categories/{category_id}`, `204`. It leaves
     *  the listing and the count, and still reads `200` and holds its name. */
    public static function deleteCategory(WebCommanderClient $client, int|string $categoryId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(CategoriesUrls::CATEGORY, pathParams: ['category_id' => $categoryId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Read one section - `GET /admin/categories/{category_id}/{section}`, `$section` being one of
     *  `CategoriesUrls::CATEGORY_SECTIONS`; the answer is `{"category": {<section>: {...}}}`. */
    public static function getCategorySection(WebCommanderClient $client, int|string $categoryId, string $section, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CategoriesUrls::CATEGORY_SECTION, pathParams: ['category_id' => $categoryId, 'section' => $section], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Category::class);
    }

    /** Merge fields into one section - `PATCH /admin/categories/{category_id}/{section}`, wrapped as
     *  `{"category": {<section>: {...}}}`; any other section in the body is ignored.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCategorySection(WebCommanderClient $client, int|string $categoryId, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CategoriesUrls::CATEGORY_SECTION, pathParams: ['category_id' => $categoryId, 'section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Category::class);
    }
}
