<?php

declare(strict_types=1);

namespace WebCommander\Resources\BlogCategories;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\BlogCategories\BlogCategoriesDto\BlogCategory;
use WebCommander\Resources\BlogCategories\BlogCategoriesDto\BlogCategoryPage;

/** Blog category endpoints; no `head` method, as the store answers `HEAD` with `404`. */
final class BlogCategories
{
    /** List the categories - `GET /admin/blog_categories`, ordered by `name`. Takes `limit` (capped
     *  at 20), `offset`, `page`, `sort`, `dir` and `field_metadata`; any other name is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listBlogCategories(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(BlogCategoriesUrls::BLOG_CATEGORIES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCategoryPage::class);
    }

    /** Create a category - `POST /admin/blog_categories`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createBlogCategory(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(BlogCategoriesUrls::BLOG_CATEGORIES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCategory::class);
    }

    /** Retrieve one category - `GET /admin/blog_categories/{blog_category_id}`, the row under
     *  `blog_category`; an unknown id is `404`. */
    public static function getBlogCategory(WebCommanderClient $client, int|string $blogCategoryId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(BlogCategoriesUrls::BLOG_CATEGORY, pathParams: ['blog_category_id' => $blogCategoryId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCategory::class);
    }

    /** Update one category - `PUT /admin/blog_categories/{blog_category_id}`, wrapped as the create
     *  is. `name` is required; an omitted `description` is blanked, `url` and `image` kept.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateBlogCategory(WebCommanderClient $client, int|string $blogCategoryId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(BlogCategoriesUrls::BLOG_CATEGORY, pathParams: ['blog_category_id' => $blogCategoryId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCategory::class);
    }

    /** Delete one category - `DELETE /admin/blog_categories/{blog_category_id}`, `204` and hard; the
     *  blogs linked to it are kept. */
    public static function deleteBlogCategory(WebCommanderClient $client, int|string $blogCategoryId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(BlogCategoriesUrls::BLOG_CATEGORY, pathParams: ['blog_category_id' => $blogCategoryId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
