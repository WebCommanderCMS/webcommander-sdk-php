<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products;

final class ProductsUrls
{
    public const PRODUCTS = '/api/{api_version}/admin/products';
    public const PRODUCTS_COUNT = '/api/{api_version}/admin/products/count';
    public const PRODUCTS_CHECK_SKU = '/api/{api_version}/admin/products/check-sku';
    public const PRODUCTS_SPECIAL = '/api/{api_version}/admin/products/special';
    public const PRODUCTS_BULK_DELETE = '/api/{api_version}/admin/products/bulk-delete';
    public const PRODUCT = '/api/{api_version}/admin/products/{product_id}';
    public const PRODUCT_REVIEWS = '/api/{api_version}/admin/products/{product_id}/reviews';
    public const PRODUCT_REVIEW = '/api/{api_version}/admin/products/{product_id}/reviews/{review_id}';
    public const PRODUCT_IMAGE = '/api/{api_version}/admin/products/{product_id}/image';
    public const PRODUCT_MEDIA = '/api/{api_version}/admin/products/{product_id}/media';
    public const PRODUCT_MEDIA_IMAGE = '/api/{api_version}/admin/products/{product_id}/media/images/{image_id}';
    public const PRODUCT_INVENTORIES = '/api/{api_version}/admin/products/{product_id}/inventories';
    public const PRODUCT_STOCK = '/api/{api_version}/admin/products/{product_id}/stock';
    public const PRODUCT_STOCK_ADJUSTMENTS = '/api/{api_version}/admin/products/{product_id}/stock/adjustments';
    public const PRODUCT_SEO = '/api/{api_version}/admin/products/{product_id}/seo';
    public const PRODUCT_MEDIA_ORDER = '/api/{api_version}/admin/products/{product_id}/media/order';
    public const PRODUCT_STOCK_LOCATION = '/api/{api_version}/admin/products/{product_id}/stock/locations/{inventory_location_id}';

    /** Tags the write with a transaction number; it wins over a body `transaction_no` it disagrees with. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
