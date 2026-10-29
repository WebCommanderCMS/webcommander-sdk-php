<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\PaymentGateways\PaymentGatewaysDto\PaymentGateway;
use WebCommander\Resources\PaymentGateways\PaymentGatewaysDto\PaymentGatewayCount;
use WebCommander\Resources\PaymentGateways\PaymentGatewaysDto\PaymentGatewayPage;

/** Payment gateway endpoints, under `/api/{api_version}/admin`. No create and no delete: `POST` and `DELETE` are `405`. */
final class PaymentGateways
{
    /** List the store's gateways by ascending `id` - `GET /admin/payment_gateways`, rows without
     *  `settings`. `limit` is 1 to 100, default 20; `0` or above 100 is `400` `out_of_range`.
     *  `offset` or `page`; `search` a substring of the name; `exclude` a comma list of codes;
     *  `promotional` and `added` filter. Other names, `sort` included, are ignored.
     *  @param array<string,mixed>|null $queryParams */
    public static function listPaymentGateways(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PaymentGatewaysUrls::PAYMENT_GATEWAYS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PaymentGatewayPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/payment_gateways`; `200` with no body. */
    public static function headPaymentGateways(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PaymentGatewaysUrls::PAYMENT_GATEWAYS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many gateways match - `GET /admin/payment_gateways/count`, a bare `{"total": N}`. The
     *  listing's filters narrow it; `limit` is checked as on the listing, `0` or above 100 `400`
     *  `out_of_range`, but changes nothing.
     *  @param array<string,mixed>|null $queryParams */
    public static function countPaymentGateways(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PaymentGatewaysUrls::PAYMENT_GATEWAYS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PaymentGatewayCount::class);
    }

    /** Ask whether the count answers - `HEAD /admin/payment_gateways/count`; `200` with no body. */
    public static function headPaymentGatewaysCount(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PaymentGatewaysUrls::PAYMENT_GATEWAYS_COUNT, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one gateway - `GET /admin/payment_gateways/{payment_gateway_id}`, with its
     *  `settings`; secrets read `********` when set. */
    public static function getPaymentGateway(WebCommanderClient $client, int|string $paymentGatewayId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(PaymentGatewaysUrls::PAYMENT_GATEWAY, pathParams: ['payment_gateway_id' => $paymentGatewayId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PaymentGateway::class);
    }

    /** Ask whether one gateway is there - `HEAD /admin/payment_gateways/{payment_gateway_id}`; no body. */
    public static function headPaymentGateway(WebCommanderClient $client, int|string $paymentGatewayId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', PaymentGatewaysUrls::PAYMENT_GATEWAY, pathParams: ['payment_gateway_id' => $paymentGatewayId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Write one gateway - `PUT /admin/payment_gateways/{payment_gateway_id}`. A bare record merged
     *  like the `PATCH`: the fields left out keep their value.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updatePaymentGateway(WebCommanderClient $client, int|string $paymentGatewayId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(PaymentGatewaysUrls::PAYMENT_GATEWAY, pathParams: ['payment_gateway_id' => $paymentGatewayId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PaymentGateway::class);
    }

    /** Change only the fields sent - `PATCH /admin/payment_gateways/{payment_gateway_id}`. A bare
     *  record; an empty body is `400`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchPaymentGateway(WebCommanderClient $client, int|string $paymentGatewayId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(PaymentGatewaysUrls::PAYMENT_GATEWAY, pathParams: ['payment_gateway_id' => $paymentGatewayId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: PaymentGateway::class);
    }
}
