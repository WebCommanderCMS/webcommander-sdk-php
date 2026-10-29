<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers;

final class AdminCustomersUrls
{
    public const ADMIN_CUSTOMERS = '/api/{api_version}/admin/customers';
    public const ADMIN_CUSTOMER = '/api/{api_version}/admin/customers/{customer_id}';
    public const ADMIN_CUSTOMERS_COUNT = '/api/{api_version}/admin/customers/count';
    public const ADMIN_CUSTOMERS_CHECK_EMAIL = '/api/{api_version}/admin/customers/check-email';
    public const ADMIN_CUSTOMERS_EXPORT = '/api/{api_version}/admin/customers/export';
    public const ADMIN_CUSTOMERS_IMPORT = '/api/{api_version}/admin/customers/import';
    public const ADMIN_CUSTOMERS_BULK_RESET_PASSWORD = '/api/{api_version}/admin/customers/bulk-reset-password';
    public const ADMIN_CUSTOMER_ADDRESSES = '/api/{api_version}/admin/customers/{customer_id}/addresses';
    public const ADMIN_CUSTOMER_RESET_PASSWORD = '/api/{api_version}/admin/customers/{customer_id}/reset-password';
    public const ADMIN_CUSTOMER_CHANGE_PASSWORD = '/api/{api_version}/admin/customers/{customer_id}/change-password';
    public const ADMIN_CUSTOMER_STORE_CREDIT_ADJUSTMENTS = '/api/{api_version}/admin/customers/{customer_id}/store-credit/adjustments';

    /** Files the new customer under this transaction number; it beats a `transaction_no` body field. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
