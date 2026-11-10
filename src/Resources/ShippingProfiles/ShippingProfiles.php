<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\ShippingProfiles\ShippingProfilesDto\ShippingProfile;
use WebCommander\Resources\ShippingProfiles\ShippingProfilesDto\ShippingProfileCount;
use WebCommander\Resources\ShippingProfiles\ShippingProfilesDto\ShippingProfileListing;

/** Shipping profile endpoints, under `/api/{api_version}/admin`. */
final class ShippingProfiles
{
    /** List the profiles, newest first - `GET /admin/shipping_profiles`. `search` (part of the name) and `default` (`true` or `false`) filter; `sort` is `id`, `name`, `description`, `rule_preference`, `created_at`, `updated_at` or `transaction_no` with `order` `asc` or `desc`; `limit` is 1 to 100 and defaults to 20, `offset` pages. An unknown value is `400`; an unknown name is ignored.
     *  @param array<string,mixed>|null $queryParams */
    public static function listShippingProfiles(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingProfilesUrls::SHIPPING_PROFILES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingProfileListing::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/shipping_profiles`; `200` with no body. */
    public static function headShippingProfiles(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingProfilesUrls::SHIPPING_PROFILES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many profiles match - `GET /admin/shipping_profiles/count`, a bare `{"total": N}`. `search` and `default` narrow it.
     *  @param array<string,mixed>|null $queryParams */
    public static function countShippingProfiles(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingProfilesUrls::SHIPPING_PROFILES_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingProfileCount::class);
    }

    /** Ask whether the count answers - `HEAD /admin/shipping_profiles/count`; `200` with no body. */
    public static function headShippingProfilesCount(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingProfilesUrls::SHIPPING_PROFILES_COUNT, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a profile - `POST /admin/shipping_profiles` with `{"shipping_profile": {...}}`, `201` with a `Location`. `name` is required and unique without regard to case (`409`); `rule_preference` defaults to `product_assigned_rule`. An unknown field, an `id` or an unwrapped body is `400`. `$transactionNo` is sent as `X-Transaction-No`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createShippingProfile(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ShippingProfilesUrls::SHIPPING_PROFILES, jsonBody: $payload, headers: $transactionNo === null ? null : [ShippingProfilesUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingProfile::class);
    }

    /** Create a profile with its rules and their rates in one call - `POST /admin/shipping_profiles/wizard`. A new profile name is `201`; a name that exists adds the rules to that profile and is `200`. Every rule's rate, class and zone is checked first, and one bad value saves nothing. A zone given as `{"name": ...}` is created.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createShippingProfileWizard(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ShippingProfilesUrls::SHIPPING_PROFILES_WIZARD, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingProfile::class);
    }

    /** Retrieve one profile - `GET /admin/shipping_profiles/{shipping_profile_id}`. An id that is not plain digits, or unknown, is `404`. */
    public static function getShippingProfile(WebCommanderClient $client, int|string $shippingProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingProfilesUrls::SHIPPING_PROFILE, pathParams: ['shipping_profile_id' => $shippingProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingProfile::class);
    }

    /** Ask whether a profile exists - `HEAD /admin/shipping_profiles/{shipping_profile_id}`; `200` with no body, `404` for an unknown id. */
    public static function headShippingProfile(WebCommanderClient $client, int|string $shippingProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingProfilesUrls::SHIPPING_PROFILE, pathParams: ['shipping_profile_id' => $shippingProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one profile - `PUT /admin/shipping_profiles/{shipping_profile_id}`. `name`, `description`, `rule_preference` and `shipping_rules` are all required (`description` may be null); the rules not listed are taken off the profile and kept.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateShippingProfile(WebCommanderClient $client, int|string $shippingProfileId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ShippingProfilesUrls::SHIPPING_PROFILE, pathParams: ['shipping_profile_id' => $shippingProfileId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingProfile::class);
    }

    /** Change only the fields sent - `PATCH /admin/shipping_profiles/{shipping_profile_id}`. `shipping_rules` is the full list, so `[]` takes every rule off. `default` true moves the store default to this profile; the default cannot be switched off directly (`409`).
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchShippingProfile(WebCommanderClient $client, int|string $shippingProfileId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ShippingProfilesUrls::SHIPPING_PROFILE, pathParams: ['shipping_profile_id' => $shippingProfileId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingProfile::class);
    }

    /** Delete one profile - `DELETE /admin/shipping_profiles/{shipping_profile_id}`, `204`. Its rules and zones stay. The store default is `409` until another profile holds the flag. */
    public static function deleteShippingProfile(WebCommanderClient $client, int|string $shippingProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ShippingProfilesUrls::SHIPPING_PROFILE, pathParams: ['shipping_profile_id' => $shippingProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
