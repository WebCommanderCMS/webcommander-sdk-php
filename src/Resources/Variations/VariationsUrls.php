<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations;

final class VariationsUrls
{
    public const VARIATIONS = '/api/{api_version}/admin/variations';
    public const VARIATION = '/api/{api_version}/admin/variations/{variation_id}';
    public const VARIATION_OPTION = '/api/{api_version}/admin/variations/{variation_id}/options/{variation_option_id}';
    public const PRODUCT_VARIATIONS = '/api/{api_version}/admin/products/{product_id}/variations';
    public const PRODUCT_VARIATIONS_BULK = '/api/{api_version}/admin/products/{product_id}/variations/bulk';

    /** Tags the write with a transaction number; it wins over a body `transaction_no` it disagrees with. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
