<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxProfiles;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxProfiles\TaxProfilesDto\TaxProfile;
use WebCommander\Resources\TaxProfiles\TaxProfilesDto\TaxProfilePage;

/** Tax profile endpoints, under `/api/{api_version}/admin/tax_profiles` and unrelated to
 *  `/admin/tax/custom-profiles`; `default` here also sets the tax settings' `default_tax_profile`. */
final class TaxProfiles
{
    /** List the profiles - `GET /admin/tax_profiles`; `limit` is capped at 20, so page on
     *  `pagination.total`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTaxProfiles(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxProfilesUrls::TAX_PROFILES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxProfilePage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/tax_profiles`; `200` with no body. */
    public static function headTaxProfiles(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxProfilesUrls::TAX_PROFILES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a profile - `POST /admin/tax_profiles`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createTaxProfile(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TaxProfilesUrls::TAX_PROFILES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxProfile::class);
    }

    /** Retrieve one profile - `GET /admin/tax_profiles/{tax_profile_id}`, the row under `tax_profile`;
     *  an unknown id is `404`. */
    public static function getTaxProfile(WebCommanderClient $client, int|string $taxProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxProfilesUrls::TAX_PROFILE, pathParams: ['tax_profile_id' => $taxProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxProfile::class);
    }

    /** Ask whether a profile's path answers - `HEAD /admin/tax_profiles/{tax_profile_id}`. */
    public static function headTaxProfile(WebCommanderClient $client, int|string $taxProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxProfilesUrls::TAX_PROFILE, pathParams: ['tax_profile_id' => $taxProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Update one profile - `PUT /admin/tax_profiles/{tax_profile_id}`, wrapped, a merge. `default: true`
     *  moves the flag, and `default_tax_profile` with it; `false` does not clear it.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateTaxProfile(WebCommanderClient $client, int|string $taxProfileId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxProfilesUrls::TAX_PROFILE, pathParams: ['tax_profile_id' => $taxProfileId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxProfile::class);
    }

    /** Delete a profile - `DELETE /admin/tax_profiles/{tax_profile_id}`. */
    public static function deleteTaxProfile(WebCommanderClient $client, int|string $taxProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(TaxProfilesUrls::TAX_PROFILE, pathParams: ['tax_profile_id' => $taxProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
