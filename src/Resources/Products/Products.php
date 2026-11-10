<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Resources\Products\ProductsDto\Product;
use WebCommander\Resources\Products\ProductsDto\ProductCount;
use WebCommander\Resources\Products\ProductsDto\ProductInventoryResult;
use WebCommander\Resources\Products\ProductsDto\ProductMediaImage;
use WebCommander\Resources\Products\ProductsDto\ProductMediaOrder;
use WebCommander\Resources\Products\ProductsDto\ProductMediaUploaded;
use WebCommander\Resources\Products\ProductsDto\ProductPage;
use WebCommander\Resources\Products\ProductsDto\ProductReview;
use WebCommander\Resources\Products\ProductsDto\ProductReviewList;
use WebCommander\Resources\Products\ProductsDto\ProductReviews;
use WebCommander\Resources\Products\ProductsDto\ProductSeo;
use WebCommander\Resources\Products\ProductsDto\ProductSkuCheck;
use WebCommander\Resources\Products\ProductsDto\ProductSpecialPage;
use WebCommander\Resources\Products\ProductsDto\ProductStock;
use WebCommander\Resources\Products\ProductsDto\ProductStockAdjustmentPage;
use WebCommander\Resources\Products\ProductsDto\ProductStockPatchResult;
use WebCommander\Resources\Products\ProductsDto\ProductsBulkDeleteResult;

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

    /** Count products - `GET /admin/products/count`; `{"total": n, "count": n}`. It takes the list's
     *  filters (`search_text`, `name`, `sku`, `ids`, `parent`, `product_type`, `stock`,
     *  `is_available`, `is_inventory_enabled`, `created_by`, `price_from`, `price_to` and the four date
     *  bounds) and refuses its paging and sorting, and `status`, as `400 unknown_parameter`. A trashed
     *  product is not counted.
     *  @param array<string,mixed>|null $queryParams */
    public static function countProducts(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCTS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductCount::class);
    }

    /** Ask whether a SKU is free - `GET /admin/products/check-sku`. The match ignores case and sees a
     *  SKU held by a trashed product or by a variant; `excludeProductId` is the `id` of a product that
     *  may hold it, as when that product is being edited. Any other query name, and `SKU` in
     *  capitals, is `400 unknown_parameter`. */
    public static function checkProductSku(WebCommanderClient $client, string $sku, int|string|null $excludeProductId = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        if ($sku === '') {
            throw new SdkUsageError('sku is required');
        }
        return $client->sendGetRequest(ProductsUrls::PRODUCTS_CHECK_SKU, queryParams: ['sku' => $sku, 'exclude_product_id' => $excludeProductId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductSkuCheck::class);
    }

    /** List a special selection of products - `GET /admin/products/special`. `type` is required:
     *  `onSale`, `featured`, `new`, `topSelling`, `lastBought` or `lastViewed`. `max` (1 to 100, default
     *  10) and `offset` page it. The last two are per customer and need `customerId` (the
     *  `customer_id` or `internal_id` of a customer) or `customer_email`; `customer_id` is not read,
     *  and an unknown customer is `400 unknown_reference`. A name it does not know is ignored.
     *  @param array<string,mixed> $queryParams */
    public static function listSpecialProducts(WebCommanderClient $client, array $queryParams, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCTS_SPECIAL, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductSpecialPage::class);
    }

    /** Move several products to the trash - `POST /admin/products/bulk-delete`, answered `200` even
     *  when an id failed. The body is `{"ids": [...]}` (the collection sends `product_ids`, which the
     *  store answers `400 required` for `ids`); an empty list is `400`. Each id that is not a product
     *  is counted in `failed` and listed in `errors`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function bulkDeleteProducts(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ProductsUrls::PRODUCTS_BULK_DELETE, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductsBulkDeleteResult::class);
    }

    /** List a product's reviews - `GET /admin/products/{product_id}/reviews`; `{"reviews": [...]}`
     *  with no paging block. `status`, `limit` and `offset` are in the collection and this store
     *  ignores them, as it does any other name.
     *  @param array<string,mixed>|null $queryParams */
    public static function listProductReviews(WebCommanderClient $client, int|string $productId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCT_REVIEWS, pathParams: ['product_id' => $productId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductReviewList::class);
    }

    /** Read one review under `review` - `GET /admin/products/{product_id}/reviews/{review_id}`.
     *  `review_id` is a review's `id`; an unknown one is `404`. */
    public static function getProductReview(WebCommanderClient $client, int|string $productId, int|string $reviewId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCT_REVIEW, pathParams: ['product_id' => $productId, 'review_id' => $reviewId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductReview::class);
    }

    /** Change one review - `PATCH /admin/products/{product_id}/reviews/{review_id}`, a bare body
     *  answered `200` with the review under `review`. `status` is `pending` (what an imported review
     *  without one reads) or `approved`; `rejected`, which the collection uses, is `400 invalid_enum`.
     *  `rating` and `comment` change too.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchProductReview(WebCommanderClient $client, int|string $productId, int|string $reviewId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ProductsUrls::PRODUCT_REVIEW, pathParams: ['product_id' => $productId, 'review_id' => $reviewId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductReview::class);
    }

    /** Delete one review for good - `DELETE /admin/products/{product_id}/reviews/{review_id}`, `204`;
     *  a second delete is `404`. */
    public static function deleteProductReview(WebCommanderClient $client, int|string $productId, int|string $reviewId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ProductsUrls::PRODUCT_REVIEW, pathParams: ['product_id' => $productId, 'review_id' => $reviewId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Set a product's stock figure - `POST /admin/products/{product_id}/inventories`, answered
     *  `201`. The body is `{"product": {"product_pricing_and_stock": {"track_inventory": true,
     *  "available_stock": n}}}`; `low_level_stock` sets the low level. It records a history row and a
     *  variant keeps its own figure. The header is stored as the product's `transaction_no` when it
     *  has none, and the answer echoes the value from before the write.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createProductInventory(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ProductsUrls::PRODUCT_INVENTORIES, pathParams: ['product_id' => $productId], jsonBody: $payload, headers: $transactionNo === null ? null : [ProductsUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductInventoryResult::class);
    }

    /** Store images on a product - `POST /admin/products/{product_id}/image`, answered `201` with the
     *  files just stored. The body is JSON, `{"product": {"image_and_video": {"images": [{"filename":
     *  ..., "base64": ...}]}}}`; a multipart body is `415`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createProductImage(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ProductsUrls::PRODUCT_IMAGE, pathParams: ['product_id' => $productId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductMediaUploaded::class);
    }

    /** Store one file on a product - `POST /admin/products/{product_id}/media`, answered `201` with
     *  a `Location` header and the stored image as one flat row, not under `product`: `id`, `filename`, `position`, `primary`, `alt_text`, `url` and `thumbnail_url`. A bare JSON body of `type`, `filename` and `content` (base64 or a `data:`
     *  URI). Only `type` `images` is accepted; `videos` and `specification_file` are
     *  `400 not_supported`. `position` (1-based) is accepted.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createProductMedia(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ProductsUrls::PRODUCT_MEDIA, pathParams: ['product_id' => $productId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductMediaImage::class);
    }

    /** Delete one image from a product - `DELETE /admin/products/{product_id}/media/images/{image_id}`,
     *  `204`; a second delete is `404`. `image_id` is an image's `id` on the product. */
    public static function deleteProductMediaImage(WebCommanderClient $client, int|string $productId, int|string $imageId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ProductsUrls::PRODUCT_MEDIA_IMAGE, pathParams: ['product_id' => $productId, 'image_id' => $imageId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Set the order of a product's images - `PUT /admin/products/{product_id}/media/order`; the first
     *  becomes `primary`. A bare `{"type": "images", "ids": [...]}` naming every image once, answered
     *  with `images` in the new order.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateProductMediaOrder(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ProductsUrls::PRODUCT_MEDIA_ORDER, pathParams: ['product_id' => $productId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductMediaOrder::class);
    }

    /** Move one image to a 1-based `position` - `PATCH /admin/products/{product_id}/media/images/{image_id}`;
     *  a bare `{"position": n}` is the only body, and the image is answered as one flat row. `image_id`
     *  is an image's `id` on the product.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchProductMediaImage(WebCommanderClient $client, int|string $productId, int|string $imageId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ProductsUrls::PRODUCT_MEDIA_IMAGE, pathParams: ['product_id' => $productId, 'image_id' => $imageId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductMediaImage::class);
    }

    /** A product's SEO, analytics, custom code, social and AI visibility settings under `seo` -
     *  `GET /admin/products/{product_id}/seo`. */
    public static function getProductSeo(WebCommanderClient $client, int|string $productId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCT_SEO, pathParams: ['product_id' => $productId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductSeo::class);
    }

    /** Change a product's stock - `PATCH /admin/products/{product_id}/stock`; a bare body of `tracking`,
     *  `locations`, `note` and `transaction_no`, at least one of them. Answered with the `stock` now and
     *  the `adjustment` it recorded, `null` when the figure did not change.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchProductStock(WebCommanderClient $client, int|string $productId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ProductsUrls::PRODUCT_STOCK, pathParams: ['product_id' => $productId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductStockPatchResult::class);
    }

    /** A product's stock history, newest first, paged by `limit` and `offset` -
     *  `GET /admin/products/{product_id}/stock/adjustments`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listProductStockAdjustments(WebCommanderClient $client, int|string $productId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ProductsUrls::PRODUCT_STOCK_ADJUSTMENTS, pathParams: ['product_id' => $productId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ProductStockAdjustmentPage::class);
    }
}
