<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderCustomFields;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\OrderCustomFields\OrderCustomFieldsDto\OrderCustomField;
use WebCommander\Resources\OrderCustomFields\OrderCustomFieldsDto\OrderCustomFieldPage;

/** Order custom field endpoints, under `/api/{api_version}/admin`. None writes a field: `POST` on
 *  the collection and `PUT`, `PATCH` and `DELETE` on a row are `405`. */
final class OrderCustomFields
{
    /** List the fields - `GET /admin/order_custom_fields`. `limit` caps at 20; `sort` takes `id`,
     *  `label`, `name`, `type`, `orderNo`, `isActive`, `created` or `updated`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listOrderCustomFields(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrderCustomFieldsUrls::ORDER_CUSTOM_FIELDS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderCustomFieldPage::class);
    }

    /** How many fields the store holds - `GET /admin/order_custom_fields/count`. `->map` is a bare
     *  `{"count": N}` and `->dto` null; `filterBy` narrows it as it narrows the listing.
     *  @param array<string,mixed>|null $queryParams */
    public static function countOrderCustomFields(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrderCustomFieldsUrls::ORDER_CUSTOM_FIELDS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one field - `GET /admin/order_custom_fields/{order_custom_field_id}`, with nine fields
     *  its listing row leaves out; `field_metadata=true` adds the schema beside it.
     *  @param array<string,mixed>|null $queryParams */
    public static function getOrderCustomField(WebCommanderClient $client, int|string $orderCustomFieldId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(OrderCustomFieldsUrls::ORDER_CUSTOM_FIELD, pathParams: ['order_custom_field_id' => $orderCustomFieldId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: OrderCustomField::class);
    }

    /** Check a timeslot - `POST /admin/order_custom_fields/{order_custom_field_id}/validate_timeslot`,
     *  a bare record answered `201 {"valid", "message"}`; nothing is stored and `->dto` is null.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function validateOrderCustomFieldTimeslot(WebCommanderClient $client, int|string $orderCustomFieldId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(OrderCustomFieldsUrls::ORDER_CUSTOM_FIELD_VALIDATE_TIMESLOT, pathParams: ['order_custom_field_id' => $orderCustomFieldId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
