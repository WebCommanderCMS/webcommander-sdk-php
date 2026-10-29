<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\CustomerGroups\CustomerGroupsDto\CustomerGroup;
use WebCommander\Resources\CustomerGroups\CustomerGroupsDto\CustomerGroupAssignment;
use WebCommander\Resources\CustomerGroups\CustomerGroupsDto\CustomerGroupCount;
use WebCommander\Resources\CustomerGroups\CustomerGroupsDto\CustomerGroupMember;
use WebCommander\Resources\CustomerGroups\CustomerGroupsDto\CustomerGroupPage;

/** Customer group endpoints; no `head` or `put` method, as the store answers them `404` and `405`. */
final class CustomerGroups
{
    /** List the groups, by `name` - `GET /admin/customer_groups`. `limit` 1 to 100, default 20;
     *  `search_text` or `name` match a name, `status` takes `A`, `I` or their words.
     *  @param array<string,mixed>|null $queryParams */
    public static function listCustomerGroups(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CustomerGroupsUrls::CUSTOMER_GROUPS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroupPage::class);
    }

    /** How many groups match - `GET /admin/customer_groups/count`; `{"total": N}`, narrowed by the
     *  listing's `search_text`, `name` and `status` and not by its paging.
     *  @param array<string,mixed>|null $queryParams */
    public static function countCustomerGroups(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CustomerGroupsUrls::CUSTOMER_GROUPS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroupCount::class);
    }

    /** Create a group - `POST /admin/customer_groups`, `201`. The body is `{"customer_group": {...}}`
     *  with `name` required, unique in any letter case.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createCustomerGroup(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(CustomerGroupsUrls::CUSTOMER_GROUPS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroup::class);
    }

    /** Retrieve one group with `customer_count` and its `customers` -
     *  `GET /admin/customer_groups/{customer_group_id}`; `field_metadata=true` adds the schema.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCustomerGroup(WebCommanderClient $client, int|string $customerGroupId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CustomerGroupsUrls::CUSTOMER_GROUP, pathParams: ['customer_group_id' => $customerGroupId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroup::class);
    }

    /** Change only the fields sent, nested ones included, in the `customer_group` wrapper -
     *  `PATCH /admin/customer_groups/{customer_group_id}`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchCustomerGroup(WebCommanderClient $client, int|string $customerGroupId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CustomerGroupsUrls::CUSTOMER_GROUP, pathParams: ['customer_group_id' => $customerGroupId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroup::class);
    }

    /** Delete one group and its memberships - `DELETE /admin/customer_groups/{customer_group_id}`,
     *  `204`; the members stay as customers. */
    public static function deleteCustomerGroup(WebCommanderClient $client, int|string $customerGroupId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(CustomerGroupsUrls::CUSTOMER_GROUP, pathParams: ['customer_group_id' => $customerGroupId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace the member list with `{"customers": [customer_id, ...]}`; `[]` empties it -
     *  `PATCH /admin/customer_groups/{customer_group_id}/customers`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateCustomerGroupCustomers(WebCommanderClient $client, int|string $customerGroupId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(CustomerGroupsUrls::CUSTOMER_GROUP_CUSTOMERS, pathParams: ['customer_group_id' => $customerGroupId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroup::class);
    }

    /** Read one member by its `customer_id`; a customer outside the group is `404` -
     *  `GET /admin/customer_groups/{customer_group_id}/customers/{customer_id}`. */
    public static function getCustomerGroupCustomer(WebCommanderClient $client, int|string $customerGroupId, int|string $customerId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CustomerGroupsUrls::CUSTOMER_GROUP_CUSTOMER, pathParams: ['customer_group_id' => $customerGroupId, 'customer_id' => $customerId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroupMember::class);
    }

    /** Add one customer to one group, keeping the other members - `POST /admin/customer_groups/assign`;
     *  `201` with `added` false for an existing member.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function assignCustomerGroup(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(CustomerGroupsUrls::CUSTOMER_GROUPS_ASSIGN, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomerGroupAssignment::class);
    }
}
