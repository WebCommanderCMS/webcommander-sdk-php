<?php

declare(strict_types=1);

namespace WebCommander\Resources\Currencies;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Currencies\CurrenciesDto\Currency;
use WebCommander\Resources\Currencies\CurrenciesDto\CurrencyBaseChange;
use WebCommander\Resources\Currencies\CurrenciesDto\CurrencyCount;
use WebCommander\Resources\Currencies\CurrenciesDto\CurrencyPage;

/** Currency endpoints, under `/api/{api_version}/admin`. */
final class Currencies
{
    /** List the currencies by ascending `id` - `GET /admin/currencies`. `search` matches `name` or
     *  `code`, `active` filters, `sort` and `dir` order, `limit` is 1 to 100.
     *  @param array<string,mixed>|null $queryParams */
    public static function listCurrencies(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CurrenciesUrls::CURRENCIES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CurrencyPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/currencies`; `200` with no body. */
    public static function headCurrencies(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CurrenciesUrls::CURRENCIES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many currencies match - `GET /admin/currencies/count`, a bare `{"total": N}`. `search`
     *  and `active` narrow it as they narrow the listing; `limit` is ignored.
     *  @param array<string,mixed>|null $queryParams */
    public static function countCurrencies(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CurrenciesUrls::CURRENCIES_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CurrencyCount::class);
    }

    /** Ask whether the count answers - `HEAD /admin/currencies/count`; `200` with no body. */
    public static function headCurrenciesCount(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CurrenciesUrls::CURRENCIES_COUNT, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a currency - `POST /admin/currencies`, `201`. A bare record: `name`, `code` and
     *  `symbol` are required, and `name` and `code` must be free. `$transactionNo` is sent as
     *  `X-Transaction-No` and files the currency under that number.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createCurrency(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(CurrenciesUrls::CURRENCIES, jsonBody: $payload, headers: $transactionNo === null ? null : [CurrenciesUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Currency::class);
    }

    /** Retrieve one currency - `GET /admin/currencies/{currency_id}`, with an `ETag`;
     *  `field_metadata` adds the schema beside it.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCurrency(WebCommanderClient $client, int|string $currencyId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CurrenciesUrls::CURRENCY, pathParams: ['currency_id' => $currencyId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Currency::class);
    }

    /** Ask whether one currency is there - `HEAD /admin/currencies/{currency_id}`; no body, the
     *  `ETag` its `GET` carries. */
    public static function headCurrency(WebCommanderClient $client, int|string $currencyId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CurrenciesUrls::CURRENCY, pathParams: ['currency_id' => $currencyId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one currency - `PUT /admin/currencies/{currency_id}`. `name`, `code` and `symbol`
     *  are required and every field left out is reset to its default; not the base.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateCurrency(WebCommanderClient $client, int|string $currencyId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(CurrenciesUrls::CURRENCY, pathParams: ['currency_id' => $currencyId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Currency::class);
    }

    /** Change only the fields sent - `PATCH /admin/currencies/{currency_id}`. An empty body is
     *  `400`, and the base currency is read-only here as on `PUT`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCurrency(WebCommanderClient $client, int|string $currencyId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CurrenciesUrls::CURRENCY, pathParams: ['currency_id' => $currencyId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Currency::class);
    }

    /** Delete a currency - `DELETE /admin/currencies/{currency_id}`, `204` and hard. The base
     *  currency is `409`: make another currency the base first. */
    public static function deleteCurrency(WebCommanderClient $client, int|string $currencyId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(CurrenciesUrls::CURRENCY, pathParams: ['currency_id' => $currencyId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Make an active currency the store's base - `PUT /admin/currencies/{currency_id}/base`; no
     *  body. Every rate is divided by the new base's old rate. */
    public static function setBaseCurrency(WebCommanderClient $client, int|string $currencyId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(CurrenciesUrls::CURRENCY_BASE, pathParams: ['currency_id' => $currencyId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CurrencyBaseChange::class);
    }
}
