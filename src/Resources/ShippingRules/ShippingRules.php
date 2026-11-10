<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRules;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\ShippingRules\ShippingRulesDto\ShippingRule;
use WebCommander\Resources\ShippingRules\ShippingRulesDto\ShippingRuleCount;
use WebCommander\Resources\ShippingRules\ShippingRulesDto\ShippingRuleListing;

/** Shipping rule endpoints, under `/api/{api_version}/admin`. */
final class ShippingRules
{
    /** List the rules, newest first - `GET /admin/shipping_rules`. `search` (part of the name), `shipping_class_id`, `zone_id`, `method` (the method of the rule's rate) and `handling_cost` (`with_handling` or `without_handling`) filter, each rule listed once; `sort` is `id`, `name`, `description`, `created_at`, `updated_at` or `transaction_no` with `order` `asc` or `desc`; `limit` is 1 to 100 and defaults to 20, `offset` pages. An unknown value or an id that names no record is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listShippingRules(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingRulesUrls::SHIPPING_RULES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRuleListing::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/shipping_rules`; `200` with no body. */
    public static function headShippingRules(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingRulesUrls::SHIPPING_RULES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** How many rules match - `GET /admin/shipping_rules/count`, a bare `{"total": N}`. The listing's filters narrow it.
     *  @param array<string,mixed>|null $queryParams */
    public static function countShippingRules(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingRulesUrls::SHIPPING_RULES_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRuleCount::class);
    }

    /** Ask whether the count answers - `HEAD /admin/shipping_rules/count`; `200` with no body. */
    public static function headShippingRulesCount(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingRulesUrls::SHIPPING_RULES_COUNT, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a rule - `POST /admin/shipping_rules` with `{"shipping_rule": {...}}`, `201` with a `Location`. `name` is required and unique without regard to case (`409`). A class, a rate and every zone must exist, `zones` without a repeat; a `profile_id` adds the rule to that profile. An unknown field, an `id` or an unwrapped body is `400`. `$transactionNo` is sent as `X-Transaction-No`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createShippingRule(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(ShippingRulesUrls::SHIPPING_RULES, jsonBody: $payload, headers: $transactionNo === null ? null : [ShippingRulesUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRule::class);
    }

    /** Retrieve one rule - `GET /admin/shipping_rules/{shipping_rule_id}`. An id that is not plain digits, or unknown, is `404`. */
    public static function getShippingRule(WebCommanderClient $client, int|string $shippingRuleId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(ShippingRulesUrls::SHIPPING_RULE, pathParams: ['shipping_rule_id' => $shippingRuleId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRule::class);
    }

    /** Ask whether a rule exists - `HEAD /admin/shipping_rules/{shipping_rule_id}`; `200` with no body, `404` for an unknown id. */
    public static function headShippingRule(WebCommanderClient $client, int|string $shippingRuleId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', ShippingRulesUrls::SHIPPING_RULE, pathParams: ['shipping_rule_id' => $shippingRuleId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Replace one rule - `PUT /admin/shipping_rules/{shipping_rule_id}`. `name`, `description`, `shipping_class`, `shipping_rate` and `zones` are all required; the first three may be null and `zones` `[]`. The rate and the zones themselves stay.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateShippingRule(WebCommanderClient $client, int|string $shippingRuleId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(ShippingRulesUrls::SHIPPING_RULE, pathParams: ['shipping_rule_id' => $shippingRuleId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRule::class);
    }

    /** Change only the fields sent - `PATCH /admin/shipping_rules/{shipping_rule_id}`. `zones` is the full list, so `[]` takes every zone off; `shipping_rate` and `shipping_class` null take the rate or the class off. The records themselves stay.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchShippingRule(WebCommanderClient $client, int|string $shippingRuleId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(ShippingRulesUrls::SHIPPING_RULE, pathParams: ['shipping_rule_id' => $shippingRuleId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: ShippingRule::class);
    }

    /** Delete one rule - `DELETE /admin/shipping_rules/{shipping_rule_id}`, `204`. A rule still on a profile is `409`; its rate and zones stay. */
    public static function deleteShippingRule(WebCommanderClient $client, int|string $shippingRuleId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(ShippingRulesUrls::SHIPPING_RULE, pathParams: ['shipping_rule_id' => $shippingRuleId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
