<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates;

final class ShippingRatesUrls
{
    public const SHIPPING_RATES = '/api/{api_version}/admin/shipping_rates';
    public const SHIPPING_RATES_COUNT = '/api/{api_version}/admin/shipping_rates/count';
    public const SHIPPING_RATE = '/api/{api_version}/admin/shipping_rates/{shipping_rate_id}';

    /** Files a new record under this transaction number; it wins over a `transaction_no` in the body. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
