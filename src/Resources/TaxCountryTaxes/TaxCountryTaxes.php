<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCountryTaxes;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxCountryTaxes\TaxCountryTaxesDto\CountryTax;
use WebCommander\Resources\TaxCountryTaxes\TaxCountryTaxesDto\CountryTaxPage;

/** Country tax endpoints, under `/api/{api_version}/admin/tax/country-taxes`; no `head` method, as
 *  the store answers `HEAD` with `404`. */
final class TaxCountryTaxes
{
    /** List the country taxes - `GET /admin/tax/country-taxes`, newest first. `limit` is 1 to 100
     *  with the cap echoed, `offset` or `page` move the window, `sort` takes `id` or `name`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTaxCountryTaxes(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxCountryTaxesUrls::TAX_COUNTRY_TAXES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CountryTaxPage::class);
    }

    /** Create a country tax - `POST /admin/tax/country-taxes`, `201`, wrapped in `country_tax`;
     *  `country_code` is required, though no read sends it back. `$transactionNo` is sent as
     *  `X-Transaction-No` and files the row under that number.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createTaxCountryTax(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TaxCountryTaxesUrls::TAX_COUNTRY_TAXES, jsonBody: $payload, headers: $transactionNo === null ? null : [TaxCountryTaxesUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CountryTax::class);
    }

    /** Retrieve one country tax - `GET /admin/tax/country-taxes/{country_tax_id}`, with an `ETag`
     *  and the `state_rules` the listing leaves out; an unknown id is `404`. */
    public static function getTaxCountryTax(WebCommanderClient $client, int|string $countryTaxId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxCountryTaxesUrls::TAX_COUNTRY_TAX, pathParams: ['country_tax_id' => $countryTaxId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CountryTax::class);
    }

    /** Update one country tax - `PUT /admin/tax/country-taxes/{country_tax_id}`, wrapped, a merge,
     *  answered `200` with an `ETag`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateTaxCountryTax(WebCommanderClient $client, int|string $countryTaxId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxCountryTaxesUrls::TAX_COUNTRY_TAX, pathParams: ['country_tax_id' => $countryTaxId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CountryTax::class);
    }

    /** Delete one country tax - `DELETE /admin/tax/country-taxes/{country_tax_id}`, `204` and hard. */
    public static function deleteTaxCountryTax(WebCommanderClient $client, int|string $countryTaxId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(TaxCountryTaxesUrls::TAX_COUNTRY_TAX, pathParams: ['country_tax_id' => $countryTaxId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
