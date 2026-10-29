<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Transactions\TransactionsDto\Transaction;
use WebCommander\Resources\Transactions\TransactionsDto\TransactionItemPage;
use WebCommander\Resources\Transactions\TransactionsDto\TransactionPage;

/** Transaction-number endpoints, under `/api/{api_version}/admin`. Read-only: `POST`, `PUT`,
 *  `PATCH` and `DELETE` are `405`. */
final class Transactions
{
    /** List the numbers in ascending order - `GET /admin/transactions`. `limit` (or `max`) from 1,
     *  default 20, held to 200; `offset`, `page`; `transaction_no` matches exactly and
     *  case-sensitively. `search`, `q`, `sort` and `order` change nothing.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTransactions(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TransactionsUrls::TRANSACTIONS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TransactionPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/transactions`; `200` with no body. */
    public static function headTransactions(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TransactionsUrls::TRANSACTIONS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Count the records one number tagged, by type - `GET /admin/transactions/{transaction_no}`.
     *  Matched exactly and case-sensitively and percent-encoded in the path; a number holding `/`
     *  is refused by the server, `400` HTML, as an encoded slash. */
    public static function getTransaction(WebCommanderClient $client, string $transactionNo, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TransactionsUrls::TRANSACTION, pathParams: ['transaction_no' => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Transaction::class);
    }

    /** Ask whether one number has records - `HEAD /admin/transactions/{transaction_no}`; no body. */
    public static function headTransaction(WebCommanderClient $client, string $transactionNo, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TransactionsUrls::TRANSACTION, pathParams: ['transaction_no' => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** List the records a number tagged, newest first -
     *  `GET /admin/transactions/{transaction_no}/items`. `type` is optional: left out, every type is
     *  listed; sent, it takes one or more of the 15 `by_type` names, comma-separated. `limit` (or
     *  `max`) 1 to 200, `offset`, `page`, `detail` `slim` or `full`. A number or a type with no
     *  records answers `200` with `items` empty and `total` `0`, not `404`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTransactionItems(WebCommanderClient $client, string $transactionNo, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TransactionsUrls::TRANSACTION_ITEMS, pathParams: ['transaction_no' => $transactionNo], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TransactionItemPage::class);
    }

    /** Ask whether the records under a number answer -
     *  `HEAD /admin/transactions/{transaction_no}/items`; no body, and `type` is optional here too.
     *  @param array<string,mixed>|null $queryParams */
    public static function headTransactionItems(WebCommanderClient $client, string $transactionNo, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TransactionsUrls::TRANSACTION_ITEMS, pathParams: ['transaction_no' => $transactionNo], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
