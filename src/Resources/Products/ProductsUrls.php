<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products;

final class ProductsUrls
{
    public const PRODUCTS = '/api/{api_version}/admin/products';
    public const PRODUCT = '/api/{api_version}/admin/products/{product_id}';
    public const PRODUCT_REVIEWS = '/api/{api_version}/admin/products/{product_id}/reviews';
    public const PRODUCT_STOCK = '/api/{api_version}/admin/products/{product_id}/stock';
    public const PRODUCT_STOCK_LOCATION = '/api/{api_version}/admin/products/{product_id}/stock/locations/{inventory_location_id}';

    /** Tags the write with a transaction number; it wins over a body `transaction_no` it disagrees with. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
