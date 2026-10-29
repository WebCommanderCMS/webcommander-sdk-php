<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\ProductListing\ProductListingDto\ProductListing as ProductListingBody;

/** Product listing endpoints - `/api/{api_version}/admin/settings/product_listing`, a facade over
 *  four sections that are body keys, not paths: one `PATCH` on the facade writes them all. */
final class ProductListing
{
    /** Retrieve the area - `GET /admin/settings/product_listing`, all four sections and `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getProductListing(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductListingUrls::PRODUCT_LISTING, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductListingBody::class);
    }

    /** Update the area - `PATCH /admin/settings/product_listing`, wrapped in `product_listing` and
     *  nothing else; partial at every level, and the only way to write a section.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchProductListing(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ProductListingUrls::PRODUCT_LISTING, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductListingBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/product_listing`; `200` with no body. */
    public static function headProductListing(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ProductListingUrls::PRODUCT_LISTING, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
