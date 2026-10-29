<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto\CustomProfile;
use WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto\CustomProfilePage;

/** Custom tax profile endpoints, under `/api/{api_version}/admin/tax/custom-profiles`; no `head`
 *  method, as the store answers `HEAD` with `404`. */
final class TaxCustomProfiles
{
    /** List the custom profiles - `GET /admin/tax/custom-profiles`, newest first. `limit` is 1 to
     *  100 with the cap echoed, `offset` or `page` move the window, `sort` takes `id` or `name`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTaxCustomProfiles(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxCustomProfilesUrls::TAX_CUSTOM_PROFILES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomProfilePage::class);
    }

    /** Create a custom profile - `POST /admin/tax/custom-profiles`, `201`, wrapped in
     *  `custom_profile`; `name` is required. `$transactionNo` is sent as `X-Transaction-No` and
     *  files the profile under that number.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createTaxCustomProfile(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TaxCustomProfilesUrls::TAX_CUSTOM_PROFILES, jsonBody: $payload, headers: $transactionNo === null ? null : [TaxCustomProfilesUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomProfile::class);
    }

    /** Retrieve one custom profile - `GET /admin/tax/custom-profiles/{custom_profile_id}`, with an
     *  `ETag` and the `rules` the listing leaves out; an unknown id is `404`. */
    public static function getTaxCustomProfile(WebCommanderClient $client, int|string $customProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxCustomProfilesUrls::TAX_CUSTOM_PROFILE, pathParams: ['custom_profile_id' => $customProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomProfile::class);
    }

    /** Replace one custom profile - `PUT /admin/tax/custom-profiles/{custom_profile_id}`, wrapped;
     *  an omitted `name` is kept, an omitted `description` or `tax_code` comes back null.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateTaxCustomProfile(WebCommanderClient $client, int|string $customProfileId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxCustomProfilesUrls::TAX_CUSTOM_PROFILE, pathParams: ['custom_profile_id' => $customProfileId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomProfile::class);
    }

    /** Delete one custom profile - `DELETE /admin/tax/custom-profiles/{custom_profile_id}`, `204` and
     *  hard. */
    public static function deleteTaxCustomProfile(WebCommanderClient $client, int|string $customProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(TaxCustomProfilesUrls::TAX_CUSTOM_PROFILE, pathParams: ['custom_profile_id' => $customProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
