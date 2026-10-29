<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto\CustomerPortal as CustomerPortalBody;

/** Customer portal endpoints, under `/api/{api_version}/admin/settings/customer_portal`: a facade
 *  over six sections, with no `PUT`. */
final class CustomerPortal
{
    /** Retrieve the area - `GET /admin/settings/customer_portal`, all six sections and `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCustomerPortal(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CustomerPortalUrls::CUSTOMER_PORTAL, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerPortalBody::class);
    }

    /** Update the area - `PATCH /admin/settings/customer_portal`, wrapped in `customer_portal` and
     *  nothing else; name only `CustomerPortalUrls::CUSTOMER_PORTAL_WRITABLE_SECTIONS`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCustomerPortal(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CustomerPortalUrls::CUSTOMER_PORTAL, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerPortalBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/customer_portal`; `200` with no body. */
    public static function headCustomerPortal(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CustomerPortalUrls::CUSTOMER_PORTAL, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/customer_portal/{section}`, under the section's own
     *  key; `$section` is one of `CustomerPortalUrls::CUSTOMER_PORTAL_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCustomerPortalSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CustomerPortalUrls::CUSTOMER_PORTAL_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerPortalBody::class);
    }

    /** Update one section - `PATCH /admin/settings/customer_portal/{section}`, wrapped in its own key or
     *  bare; `$section` must be one of `CustomerPortalUrls::CUSTOMER_PORTAL_WRITABLE_SECTIONS`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCustomerPortalSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CustomerPortalUrls::CUSTOMER_PORTAL_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerPortalBody::class);
    }
}
