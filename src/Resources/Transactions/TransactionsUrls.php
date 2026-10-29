<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions;

final class TransactionsUrls
{
    public const TRANSACTIONS = '/api/{api_version}/admin/transactions';
    public const TRANSACTION = '/api/{api_version}/admin/transactions/{transaction_no}';
    public const TRANSACTION_ITEMS = '/api/{api_version}/admin/transactions/{transaction_no}/items';
}
