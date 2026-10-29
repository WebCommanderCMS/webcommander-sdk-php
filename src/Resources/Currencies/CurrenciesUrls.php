<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies;

final class CurrenciesUrls
{
    public const CURRENCIES = '/api/{api_version}/admin/currencies';
    public const CURRENCIES_COUNT = '/api/{api_version}/admin/currencies/count';
    public const CURRENCY = '/api/{api_version}/admin/currencies/{currency_id}';
    public const CURRENCY_BASE = '/api/{api_version}/admin/currencies/{currency_id}/base';

    /** Files a new currency under this transaction number, the only way: a body field is `400`. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
