<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Customers\AdminCustomersDto\Page;
use WebCommander\Resources\Settings\PageSettings\SearchResultPageDto\ProductPromotion;
use WebCommander\Resources\Settings\PageSettings\SearchResultPageDto\SearchResultPage as SearchResultPageBody;

/** Search result page settings: a facade over three sections and the `product_promotion` collection,
 *  under `/api/{api_version}/admin/settings/page_settings/search_result_page`. */
final class SearchResultPage
{
    /** Retrieve the area - `GET /admin/settings/page_settings/search_result_page`, the sections and
     *  `group_meta`; the promotions are not inlined.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSearchResultPage(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchResultPageBody::class);
    }

    /** Update the area - `PATCH /admin/settings/page_settings/search_result_page`, wrapped in
     *  `search_result_page`; partial at every level. There is no `PUT`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSearchResultPage(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchResultPageBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/page_settings/search_result_page`; `200`
     *  with no body and an `ETag`. */
    public static function headSearchResultPage(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SearchResultPageUrls::SEARCH_RESULT_PAGE, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/page_settings/search_result_page/{section}`, one of
     *  `SearchResultPageUrls::SEARCH_RESULT_PAGE_SECTIONS`, under the facade's key, not the section's.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSearchResultPageSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchResultPageBody::class);
    }

    /** Update one section - `PATCH /admin/settings/page_settings/search_result_page/{section}`, wrapped
     *  in the section's own key; only `product_information` is writable.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSearchResultPageSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: SearchResultPageBody::class);
    }

    /** List the promotions - `GET /admin/settings/page_settings/search_result_page/product_promotion`,
     *  rows under `product_promotions`; `offset` pages it and `limit` is not applied.
     *  @param array<string,mixed>|null $queryParams */
    public static function getSearchResultPageProductPromotions(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTIONS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::of(ProductPromotion::class));
    }

    /** Ask whether the promotions collection answers -
     *  `HEAD /admin/settings/page_settings/search_result_page/product_promotion`; `200` with no body. */
    public static function headSearchResultPageProductPromotions(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTIONS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a promotion - `POST /admin/settings/page_settings/search_result_page/product_promotion`,
     *  `201`, wrapped in `product_promotion`; `name`, `rule` and `position` are required.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createSearchResultPageProductPromotion(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTIONS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPromotion::class);
    }

    /** Retrieve one promotion, the row under `product_promotion` -
     *  `GET /admin/settings/page_settings/search_result_page/product_promotion/{promotion_id}`. */
    public static function getSearchResultPageProductPromotion(WebCommanderClient $client, int|string $promotionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTION, pathParams: ['promotion_id' => $promotionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPromotion::class);
    }

    /** Ask whether one promotion is there -
     *  `HEAD /admin/settings/page_settings/search_result_page/product_promotion/{promotion_id}`; no body,
     *  an `ETag`, and `404` for an unknown id. */
    public static function headSearchResultPageProductPromotion(WebCommanderClient $client, int|string $promotionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTION, pathParams: ['promotion_id' => $promotionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Update one promotion, wrapped and partial -
     *  `PATCH /admin/settings/page_settings/search_result_page/product_promotion/{promotion_id}`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSearchResultPageProductPromotion(WebCommanderClient $client, int|string $promotionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTION, pathParams: ['promotion_id' => $promotionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPromotion::class);
    }

    /** Switch one promotion on or off, `{"product_promotion": {"is_active": ...}}`, all else ignored -
     *  `PATCH /admin/settings/page_settings/search_result_page/product_promotion/{promotion_id}/active`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchSearchResultPageProductPromotionActive(WebCommanderClient $client, int|string $promotionId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTION_ACTIVE, pathParams: ['promotion_id' => $promotionId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPromotion::class);
    }

    /** Delete one promotion, `204`; nothing restores it -
     *  `DELETE /admin/settings/page_settings/search_result_page/product_promotion/{promotion_id}`. */
    public static function deleteSearchResultPageProductPromotion(WebCommanderClient $client, int|string $promotionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(SearchResultPageUrls::SEARCH_RESULT_PAGE_PRODUCT_PROMOTION, pathParams: ['promotion_id' => $promotionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
