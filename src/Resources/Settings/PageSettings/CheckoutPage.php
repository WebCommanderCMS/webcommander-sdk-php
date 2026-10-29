<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\PageSettings\CheckoutPageDto\CheckoutPage as CheckoutPageBody;

/** Checkout page settings: a facade over six sections, with no `PUT`, under
 *  `/api/{api_version}/admin/settings/page_settings/checkout_page`. */
final class CheckoutPage
{
    /** Retrieve the area - `GET /admin/settings/page_settings/checkout_page`, all six sections and
     *  `group_meta`; the address sections carry only their active field keys here.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCheckoutPage(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CheckoutPageUrls::CHECKOUT_PAGE, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CheckoutPageBody::class);
    }

    /** Update the area - `PATCH /admin/settings/page_settings/checkout_page`, wrapped in
     *  `checkout_page` and nothing else; partial at every level.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCheckoutPage(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CheckoutPageUrls::CHECKOUT_PAGE, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CheckoutPageBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/page_settings/checkout_page`; `200` with no
     *  body and an `ETag`. */
    public static function headCheckoutPage(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CheckoutPageUrls::CHECKOUT_PAGE, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/page_settings/checkout_page/{section}`, under the
     *  section's own key; `$section` is one of `CheckoutPageUrls::CHECKOUT_PAGE_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCheckoutPageSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CheckoutPageUrls::CHECKOUT_PAGE_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CheckoutPageBody::class);
    }

    /** Update one section - `PATCH /admin/settings/page_settings/checkout_page/{section}`, wrapped in
     *  the section's own key; `$section` is one of `CheckoutPageUrls::CHECKOUT_PAGE_WRITABLE_SECTIONS`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCheckoutPageSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CheckoutPageUrls::CHECKOUT_PAGE_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CheckoutPageBody::class);
    }
}
