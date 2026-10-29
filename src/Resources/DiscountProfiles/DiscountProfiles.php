<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\DiscountProfiles\DiscountProfilesDto\DiscountProfile;
use WebCommander\Resources\DiscountProfiles\DiscountProfilesDto\DiscountProfileCoupons;
use WebCommander\Resources\DiscountProfiles\DiscountProfilesDto\DiscountProfilePage;

/** Discount profile endpoints, under `/api/{api_version}/admin`, and the two coupon paths beside
 *  them. No path here serves `HEAD` or `OPTIONS`, and `PATCH` on a row is `405`. */
final class DiscountProfiles
{
    /** List the profiles - `GET /admin/discount_profiles`, newest `id` first. `limit` is capped at
     *  20; an unknown query name is ignored, not refused.
     *  @param array<string,mixed>|null $queryParams */
    public static function listDiscountProfiles(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DiscountProfilesUrls::DISCOUNT_PROFILES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DiscountProfilePage::class);
    }

    /** Create a profile - `POST /admin/discount_profiles`, `201`. The body is a bare record:
     *  `name`, `discount_details_type` and the details block it names are required.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createDiscountProfile(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(DiscountProfilesUrls::DISCOUNT_PROFILES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DiscountProfile::class);
    }

    /** Retrieve one profile - `GET /admin/discount_profiles/{discount_profile_id}`, the row under
     *  `discount_profile`; `field_metadata` adds the field schema beside it.
     *  @param array<string,mixed>|null $queryParams */
    public static function getDiscountProfile(WebCommanderClient $client, int|string $discountProfileId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(DiscountProfilesUrls::DISCOUNT_PROFILE, pathParams: ['discount_profile_id' => $discountProfileId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DiscountProfile::class);
    }

    /** Replace a profile - `PUT /admin/discount_profiles/{discount_profile_id}`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateDiscountProfile(WebCommanderClient $client, int|string $discountProfileId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(DiscountProfilesUrls::DISCOUNT_PROFILE, pathParams: ['discount_profile_id' => $discountProfileId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DiscountProfile::class);
    }

    /** Delete one profile and its coupons - `DELETE /admin/discount_profiles/{discount_profile_id}`,
     *  `204` with no body, and hard. */
    public static function deleteDiscountProfile(WebCommanderClient $client, int|string $discountProfileId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(DiscountProfilesUrls::DISCOUNT_PROFILE, pathParams: ['discount_profile_id' => $discountProfileId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Generate codes on a profile that has `is_apply_coupon_code` -
     *  `POST /admin/discount_profiles/{discount_profile_id}/create-coupons`, `{"requested_codes": n}`, `201`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createDiscountProfileCoupons(WebCommanderClient $client, int|string $discountProfileId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(DiscountProfilesUrls::DISCOUNT_PROFILE_CREATE_COUPONS, pathParams: ['discount_profile_id' => $discountProfileId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: DiscountProfileCoupons::class);
    }

    /** Assign a generated code to a customer - `POST /admin/discount_coupons/assign-customer`, `201`.
     *  The body is `{"code", "email"}`; the answer is a verdict, so `->dto` is null.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function assignDiscountCouponCustomer(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(DiscountProfilesUrls::DISCOUNT_COUPONS_ASSIGN_CUSTOMER, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
