<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\PageSettings\ProductPageDto\ProductPage as ProductPageBody;

/** Product page settings: a facade over seven sections, with no `PUT`, under
 *  `/api/{api_version}/admin/settings/page_settings/product_page`. */
final class ProductPage
{
    /** Retrieve the area - `GET /admin/settings/page_settings/product_page`, all seven sections and
     *  `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getProductPage(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductPageUrls::PRODUCT_PAGE, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPageBody::class);
    }

    /** Update the area - `PATCH /admin/settings/page_settings/product_page`, wrapped in `product_page`
     *  or bare; partial at every level.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchProductPage(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ProductPageUrls::PRODUCT_PAGE, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPageBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/page_settings/product_page`; `200` with no
     *  body and an `ETag`. */
    public static function headProductPage(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ProductPageUrls::PRODUCT_PAGE, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/page_settings/product_page/{section}`, one of
     *  `ProductPageUrls::PRODUCT_PAGE_SECTIONS`, under the facade's key, not the section's.
     *  @param array<string,mixed>|null $queryParams */
    public static function getProductPageSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductPageUrls::PRODUCT_PAGE_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPageBody::class);
    }

    /** Update one section - `PATCH /admin/settings/page_settings/product_page/{section}`, wrapped in the
     *  facade's key or the section's; a field enabled while its `depends_on` is off is `400`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchProductPageSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ProductPageUrls::PRODUCT_PAGE_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPageBody::class);
    }
}
