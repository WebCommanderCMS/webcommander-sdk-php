<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Pages\PagesDto\Page;
use WebCommander\Resources\Pages\PagesDto\PageCount;
use WebCommander\Resources\Pages\PagesDto\PageDeleteBlockers;
use WebCommander\Resources\Pages\PagesDto\PageListing;

/** Page endpoints, under `/api/{api_version}/admin`. */
final class Pages
{
    /** List the pages outside the trash, newest change first - `GET /admin/pages`. `search`,
     *  `active`, `has_layout`, `visibility`, `created_from`/`created_to`, `updated_from`/`updated_to`
     *  (`YYYY-MM-DD`), `author`, `store` and `not_in_store` filter; `sort` and `order` order; `limit`
     *  is 1 to 100 or `all`. Unknown names are `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listPages(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PagesUrls::PAGES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PageListing::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/pages`; `200` with no body. */
    public static function headPages(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PagesUrls::PAGES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many pages match - `GET /admin/pages/count`, a bare `{"total": N}`. The listing's filters
     *  narrow it; `sort`, `order`, `limit` and `offset` are ignored.
     *  @param array<string,mixed>|null $queryParams */
    public static function countPages(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PagesUrls::PAGES_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PageCount::class);
    }

    /** Ask whether the count answers - `HEAD /admin/pages/count`; `200` with no body. */
    public static function headPagesCount(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PagesUrls::PAGES_COUNT, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a page - `POST /admin/pages` with `{"page": {...}}`, `201`. `name` and `visibility`
     *  are required; the URL is made from the name.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createPage(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(PagesUrls::PAGES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::class);
    }

    /** Retrieve one page - `GET /admin/pages/{page_id}`, with an `ETag`; a page in the trash still
     *  reads, `in_trash` true. */
    public static function getPage(WebCommanderClient $client, int|string $pageId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PagesUrls::PAGE, pathParams: ['page_id' => $pageId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::class);
    }

    /** Ask whether one page is there - `HEAD /admin/pages/{page_id}`; no body, the `ETag` its `GET`
     *  carries. */
    public static function headPage(WebCommanderClient $client, int|string $pageId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PagesUrls::PAGE, pathParams: ['page_id' => $pageId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one page - `PUT /admin/pages/{page_id}`. `name`, `title`, `subtitle`, `url`,
     *  `layout`, `visibility`, `body_class`, `active`, `disable_tracking` and `password_protection`
     *  are required, a partial body is `400`; `subtitle`, `layout` and `body_class` take null.
     *  `$ifMatch` is sent as `If-Match`: a stale `ETag` is `412`, checked before the body.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updatePage(WebCommanderClient $client, int|string $pageId, array|string|Dto $payload, ?string $ifMatch = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(PagesUrls::PAGE, pathParams: ['page_id' => $pageId], jsonBody: $payload, headers: $ifMatch === null ? null : [PagesUrls::IF_MATCH_HEADER => $ifMatch], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::class);
    }

    /** Change only the fields sent - `PATCH /admin/pages/{page_id}`; an empty `page` is `400` and a
     *  page in the trash `409`. `$ifMatch` is sent as `If-Match`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchPage(WebCommanderClient $client, int|string $pageId, array|string|Dto $payload, ?string $ifMatch = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(PagesUrls::PAGE, pathParams: ['page_id' => $pageId], jsonBody: $payload, headers: $ifMatch === null ? null : [PagesUrls::IF_MATCH_HEADER => $ifMatch], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::class);
    }

    /** Move a page to the trash - `DELETE /admin/pages/{page_id}`, `204`. `force` `true` purges it,
     *  from the trash or live; a second plain delete is `400`. The landing page is `409`.
     *  `$ifMatch` is sent as `If-Match`.
     *  @param array<string,mixed>|null $queryParams */
    public static function deletePage(WebCommanderClient $client, int|string $pageId, ?array $queryParams = null, ?string $ifMatch = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(PagesUrls::PAGE, pathParams: ['page_id' => $pageId], queryParams: $queryParams, headers: $ifMatch === null ? null : [PagesUrls::IF_MATCH_HEADER => $ifMatch], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Move a page to a new URL - `PUT /admin/pages/{page_id}/url` with a bare `{"url": ...}`;
     *  answers the page. A URL another page holds is `409`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updatePageUrl(WebCommanderClient $client, int|string $pageId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(PagesUrls::PAGE_URL, pathParams: ['page_id' => $pageId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::class);
    }

    /** Make a page the store's landing page - `PATCH /admin/pages/{page_id}/landing`; no body. The
     *  previous landing page stops being it. */
    public static function setLandingPage(WebCommanderClient $client, int|string $pageId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(PagesUrls::PAGE_LANDING, pathParams: ['page_id' => $pageId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::class);
    }

    /** Whether a delete would pass and what blocks it, such as `landing_page` -
     *  `GET /admin/pages/{page_id}/delete-blockers`. */
    public static function getPageDeleteBlockers(WebCommanderClient $client, int|string $pageId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PagesUrls::PAGE_DELETE_BLOCKERS, pathParams: ['page_id' => $pageId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PageDeleteBlockers::class);
    }

    /** Ask whether the delete check answers - `HEAD /admin/pages/{page_id}/delete-blockers`; `200`
     *  with no body. */
    public static function headPageDeleteBlockers(WebCommanderClient $client, int|string $pageId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PagesUrls::PAGE_DELETE_BLOCKERS, pathParams: ['page_id' => $pageId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Copy a page - `POST /admin/pages/{page_id}/duplicate`, `201`; a body field is `400`. The copy
     *  is `"<name> - Copy"` at `<url>-copy`, then `- Copy 1` at `-copy-1`. */
    public static function duplicatePage(WebCommanderClient $client, int|string $pageId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(PagesUrls::PAGE_DUPLICATE, pathParams: ['page_id' => $pageId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::class);
    }
}
