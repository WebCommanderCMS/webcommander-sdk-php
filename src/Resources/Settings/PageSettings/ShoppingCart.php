<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Settings\PageSettings\ShoppingCartDto\ShoppingCart as ShoppingCartBody;

/** Shopping cart settings: a facade over two sections, with no `PUT`, under
 *  `/api/{api_version}/admin/settings/page_settings/shopping_cart`. */
final class ShoppingCart
{
    /** Retrieve the area - `GET /admin/settings/page_settings/shopping_cart`, both sections and
     *  `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getShoppingCart(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShoppingCartUrls::SHOPPING_CART, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShoppingCartBody::class);
    }

    /** Update the area - `PATCH /admin/settings/page_settings/shopping_cart`, wrapped in
     *  `shopping_cart`; partial.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchShoppingCart(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ShoppingCartUrls::SHOPPING_CART, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShoppingCartBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/page_settings/shopping_cart`; `200` with no
     *  body and an `ETag`. */
    public static function headShoppingCart(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShoppingCartUrls::SHOPPING_CART, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/page_settings/shopping_cart/{section}`, under the
     *  section's own key; `$section` is one of `ShoppingCartUrls::SHOPPING_CART_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getShoppingCartSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShoppingCartUrls::SHOPPING_CART_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShoppingCartBody::class);
    }

    /** Update one section - `PATCH /admin/settings/page_settings/shopping_cart/{section}`, wrapped in
     *  the section's own key; only the fields being changed need appear.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchShoppingCartSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ShoppingCartUrls::SHOPPING_CART_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShoppingCartBody::class);
    }
}
