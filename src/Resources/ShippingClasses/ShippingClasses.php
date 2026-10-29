<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingClasses;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\ShippingClasses\ShippingClassesDto\ShippingClass;
use WebCommander\Resources\ShippingClasses\ShippingClassesDto\ShippingClassCount;
use WebCommander\Resources\ShippingClasses\ShippingClassesDto\ShippingClassPage;

/** Shipping class endpoints, under `/api/{api_version}/admin` and not `/admin/settings/`; nothing
 *  here reads or writes `shippingSettings`. */
final class ShippingClasses
{
    /** List the classes - `GET /admin/shipping_classes`, a created row listed first. Takes `limit`
     *  (capped at 20), `offset`, `page` and `field_metadata`; `sort` is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listShippingClasses(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingClassesUrls::SHIPPING_CLASSES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingClassPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/shipping_classes`; `200` with no body. */
    public static function headShippingClasses(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingClassesUrls::SHIPPING_CLASSES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many classes the store holds - `GET /admin/shipping_classes/count`, answering
     *  `{"shipping_classes": {"count": N}}`; no query parameter narrows it.
     *  @param array<string,mixed>|null $queryParams */
    public static function countShippingClasses(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingClassesUrls::SHIPPING_CLASSES_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingClassCount::class);
    }

    /** Create a class - `POST /admin/shipping_classes`, `201`; the `shipping_class` wrapper is
     *  required, `id` and `is_default` are discarded, and an omitted `description` is null.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createShippingClass(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ShippingClassesUrls::SHIPPING_CLASSES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingClass::class);
    }

    /** Retrieve one class - `GET /admin/shipping_classes/{shipping_class_id}`, the row under
     *  `shipping_class`; `field_metadata=true` adds the schema beside it. An unknown id is `404`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getShippingClass(WebCommanderClient $client, int|string $shippingClassId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingClassesUrls::SHIPPING_CLASS, pathParams: ['shipping_class_id' => $shippingClassId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingClass::class);
    }

    /** Ask whether a class's path answers - `HEAD /admin/shipping_classes/{shipping_class_id}`. */
    public static function headShippingClass(WebCommanderClient $client, int|string $shippingClassId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingClassesUrls::SHIPPING_CLASS, pathParams: ['shipping_class_id' => $shippingClassId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one class - `PUT /admin/shipping_classes/{shipping_class_id}`, wrapper and `name`
     *  required; a `description` left out comes back null. `PATCH` has no handler.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateShippingClass(WebCommanderClient $client, int|string $shippingClassId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ShippingClassesUrls::SHIPPING_CLASS, pathParams: ['shipping_class_id' => $shippingClassId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingClass::class);
    }

    /** Delete one class - `DELETE /admin/shipping_classes/{shipping_class_id}`, `204` and hard. The
     *  row holding `is_default` is `409 conflict` until the flag moves to another. */
    public static function deleteShippingClass(WebCommanderClient $client, int|string $shippingClassId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ShippingClassesUrls::SHIPPING_CLASS, pathParams: ['shipping_class_id' => $shippingClassId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Make one class the default - `PUT /admin/shipping_classes/{shipping_class_id}/default`, no
     *  body read. The flag is exclusive: the row that held it loses it. */
    public static function setShippingClassDefault(WebCommanderClient $client, int|string $shippingClassId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ShippingClassesUrls::SHIPPING_CLASS_DEFAULT, pathParams: ['shipping_class_id' => $shippingClassId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingClass::class);
    }
}
