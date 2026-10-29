<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Variations\VariationsDto\ProductVariations;
use WebCommander\Resources\Variations\VariationsDto\ProductVariationsBulkResult;
use WebCommander\Resources\Variations\VariationsDto\ProductVariationsImportResult;
use WebCommander\Resources\Variations\VariationsDto\Variation;
use WebCommander\Resources\Variations\VariationsDto\VariationPage;

/** Variation type and product variant endpoints, under `/api/{api_version}/admin`. */
final class Variations
{
    /** List the types by ascending id - `GET /admin/variations`. Accepts `search` (name),
     *  `standard`, `limit` (1 to 100), `offset` or `page`, and `field_metadata`; any other name is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listVariations(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(VariationsUrls::VARIATIONS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: VariationPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/variations`; `200` with no body. */
    public static function headVariations(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', VariationsUrls::VARIATIONS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a type - `POST /admin/variations`, `201`. The body is `{"variation": {...}}` with
     *  `name`, `standard` and at least one option.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createVariation(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(VariationsUrls::VARIATIONS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Variation::class);
    }

    /** Retrieve one type - `GET /admin/variations/{variation_id}`; `field_metadata` adds the schema
     *  beside it.
     *  @param array<string,mixed>|null $queryParams */
    public static function getVariation(WebCommanderClient $client, int|string $variationId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(VariationsUrls::VARIATION, pathParams: ['variation_id' => $variationId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Variation::class);
    }

    /** Ask whether one type is there - `HEAD /admin/variations/{variation_id}`; no body, and the
     *  row read's `ETag`. */
    public static function headVariation(WebCommanderClient $client, int|string $variationId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', VariationsUrls::VARIATION, pathParams: ['variation_id' => $variationId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one type - `PUT /admin/variations/{variation_id}`. `name` and `options` are
     *  required, and an option left out of the list is deleted.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateVariation(WebCommanderClient $client, int|string $variationId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(VariationsUrls::VARIATION, pathParams: ['variation_id' => $variationId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Variation::class);
    }

    /** Merge into one type - `PATCH /admin/variations/{variation_id}`. Only the options sent are
     *  added, or changed where an `id` names one; the rest are kept.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchVariation(WebCommanderClient $client, int|string $variationId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(VariationsUrls::VARIATION, pathParams: ['variation_id' => $variationId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Variation::class);
    }

    /** Delete one type - `DELETE /admin/variations/{variation_id}`, `204`. A type with options is
     *  `409` unless `cascade` is `true`, which deletes them with it.
     *  @param array<string,mixed>|null $queryParams */
    public static function deleteVariation(WebCommanderClient $client, int|string $variationId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(VariationsUrls::VARIATION, pathParams: ['variation_id' => $variationId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Delete one option of a type - `DELETE /admin/variations/{variation_id}/options/{variation_option_id}`,
     *  `204`; a type's last option is `409`. */
    public static function deleteVariationOption(WebCommanderClient $client, int|string $variationId, int|string $variationOptionId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(VariationsUrls::VARIATION_OPTION, pathParams: ['variation_id' => $variationId, 'variation_option_id' => $variationOptionId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** One product's variants, grouped and unpaged - `GET /admin/products/{product_id}/variations`;
     *  a tax-inclusive product's prices read net of tax. */
    public static function listProductVariations(WebCommanderClient $client, int|string $productId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(VariationsUrls::PRODUCT_VARIATIONS, pathParams: ['product_id' => $productId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductVariations::class);
    }

    /** Add or change a product's variants by `key` - `POST /admin/products/{product_id}/variations`;
     *  `201`. A `product_key` naming other types than the product's is `409`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function importProductVariations(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(VariationsUrls::PRODUCT_VARIATIONS, pathParams: ['product_id' => $productId], jsonBody: $payload, headers: $transactionNo === null ? null : [VariationsUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductVariationsImportResult::class);
    }

    /** Set fields on several variants of one product - `PATCH /admin/products/{product_id}/variations/bulk`,
     *  a bare record. `response` is `slim` or `full`.
     *  @param array<string,mixed>|string|Dto $payload
     *  @param array<string,mixed>|null $queryParams */
    public static function updateProductVariations(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(VariationsUrls::PRODUCT_VARIATIONS_BULK, pathParams: ['product_id' => $productId], queryParams: $queryParams, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductVariationsBulkResult::class);
    }
}
