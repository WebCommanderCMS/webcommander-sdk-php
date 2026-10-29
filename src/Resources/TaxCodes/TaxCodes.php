<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCodes;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxCodes\TaxCodesDto\TaxCode;
use WebCommander\Resources\TaxCodes\TaxCodesDto\TaxCodePage;

/** Tax code endpoints, under `/api/{api_version}/admin/tax_codes`; every write takes the `tax_code`
 *  wrapper. */
final class TaxCodes
{
    /** List the codes - `GET /admin/tax_codes`; `limit` is capped at 100, so page on `pagination.total`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTaxCodes(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxCodesUrls::TAX_CODES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxCodePage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/tax_codes`; `200` with no body. */
    public static function headTaxCodes(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxCodesUrls::TAX_CODES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a code - `POST /admin/tax_codes`, `201`, wrapped in `tax_code`; `name` is required and
     *  `default` is not writable.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createTaxCode(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TaxCodesUrls::TAX_CODES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxCode::class);
    }

    /** Retrieve one code - `GET /admin/tax_codes/{tax_code_id}`, the row under `tax_code`; an unknown
     *  id is `404`. */
    public static function getTaxCode(WebCommanderClient $client, int|string $taxCodeId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxCodesUrls::TAX_CODE, pathParams: ['tax_code_id' => $taxCodeId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxCode::class);
    }

    /** Ask whether a code's path answers - `HEAD /admin/tax_codes/{tax_code_id}`. */
    public static function headTaxCode(WebCommanderClient $client, int|string $taxCodeId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxCodesUrls::TAX_CODE, pathParams: ['tax_code_id' => $taxCodeId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Update one code - `PUT /admin/tax_codes/{tax_code_id}`, wrapped in `tax_code`. Omitted fields keep
     *  their values except `priority` and `resolver_type`, which reset to `0` and `flat`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateTaxCode(WebCommanderClient $client, int|string $taxCodeId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxCodesUrls::TAX_CODE, pathParams: ['tax_code_id' => $taxCodeId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxCode::class);
    }

    /** Delete one code - `DELETE /admin/tax_codes/{tax_code_id}`, `204` and hard. */
    public static function deleteTaxCode(WebCommanderClient $client, int|string $taxCodeId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(TaxCodesUrls::TAX_CODE, pathParams: ['tax_code_id' => $taxCodeId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
