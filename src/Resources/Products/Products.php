<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Products\ProductsDto\Product;
use WebCommander\Resources\Products\ProductsDto\ProductPage;
use WebCommander\Resources\Products\ProductsDto\ProductReviews;
use WebCommander\Resources\Products\ProductsDto\ProductStock;

/** Product endpoints, under `/api/{api_version}/admin`: a product's row, its reviews and its stock. */
final class Products
{
    /** List products, the most recently updated first - `GET /admin/products`; each row is the full
     *  record the row read answers, and a trashed product is not listed. `limit` is 1 to 100 (default
     *  20, above 100 is `400`), with `offset` or a 1-based `page`. `search_text` matches `name` or
     *  `sku`; `name`, `sku`, `ids` (repeat the name for more; a comma list is `500`), `parent` (a
     *  category id), `product_type`, `stock` (`in`, `out` or `low`), `is_available`,
     *  `is_inventory_enabled`, `created_by`, `price_from`, `price_to`, `created_from`, `created_to`,
     *  `updated_from` and `updated_to` narrow it. `sort` takes `name`, `isAvailable`, `sku`, `parent`,
     *  `basePrice`, `isInventoryEnabled`, `createdBy`, `created`, `updated` or `id`, with `dir`;
     *  `field_metadata` adds a schema. Any other name is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listProducts(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCTS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductPage::class);
    }

    /** Create a product - `POST /admin/products`, `201`. A bare record: `name` and `base_price` are
     *  required, `sku` must be free, and the store makes one when left out.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createProduct(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ProductsUrls::PRODUCTS, jsonBody: $payload, headers: $transactionNo === null ? null : [ProductsUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Product::class);
    }

    /** Retrieve one product - `GET /admin/products/{product_id}`. `field_metadata=true` adds a
     *  field schema beside `product`; any other name is `400 unknown_parameter`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getProduct(WebCommanderClient $client, int|string $productId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCT, pathParams: ['product_id' => $productId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Product::class);
    }

    /** Update one product - `PUT /admin/products/{product_id}`. A bare record merged at every
     *  level; it must carry `name`, `sku`, `base_price`, `product_type`, `available`, `is_on_sale`,
     *  `available_on_date_range`, `available_on_weekdays`, `available_for` and `selected_customers`
     *  (`400 required` otherwise), and fields left out keep their values. `{"product": {...}}` is
     *  `400 unknown_field`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateProduct(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ProductsUrls::PRODUCT, pathParams: ['product_id' => $productId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Product::class);
    }

    /** Merge into one product - `PATCH /admin/products/{product_id}`, the same bare record the `PUT`
     *  takes; a product in the trash is `409`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchProduct(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ProductsUrls::PRODUCT, pathParams: ['product_id' => $productId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Product::class);
    }

    /** Move a product to the trash - `DELETE /admin/products/{product_id}`, `204`. It still reads
     *  back, `status` `trashed`, and a second delete is `404`. */
    public static function deleteProduct(WebCommanderClient $client, int|string $productId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ProductsUrls::PRODUCT, pathParams: ['product_id' => $productId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Add reviews to a product - `POST /admin/products/{product_id}/reviews`; `201` with every
     *  review it holds. The body is `{"product": {"reviews": [...]}}`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function importProductReviews(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ProductsUrls::PRODUCT_REVIEWS, pathParams: ['product_id' => $productId], jsonBody: $payload, headers: $transactionNo === null ? null : [ProductsUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductReviews::class);
    }

    /** One product's stock at each location - `GET /admin/products/{product_id}/stock`. */
    public static function getProductStock(WebCommanderClient $client, int|string $productId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCT_STOCK, pathParams: ['product_id' => $productId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductStock::class);
    }

    /** Set the product's stock - `PUT /admin/products/{product_id}/stock`. `locations` replaces
     *  the whole set: a location left out is unassigned, so send every row that is to stay.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateProductStock(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ProductsUrls::PRODUCT_STOCK, pathParams: ['product_id' => $productId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductStock::class);
    }

    /** Unassign one location from the product -
     *  `DELETE /admin/products/{product_id}/stock/locations/{inventory_location_id}`, `204`. The
     *  location must hold `0` units and not be the product's default, or it is `409`. */
    public static function deleteProductStockLocation(WebCommanderClient $client, int|string $productId, int|string $inventoryLocationId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ProductsUrls::PRODUCT_STOCK_LOCATION, pathParams: ['product_id' => $productId, 'inventory_location_id' => $inventoryLocationId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
