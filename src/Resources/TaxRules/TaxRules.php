<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxRules;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\TaxRules\TaxRulesDto\TaxRule;
use WebCommander\Resources\TaxRules\TaxRulesDto\TaxRulePage;

/** Tax rule endpoints, under `/api/{api_version}/admin/tax_rules`. A rule reads its `code` and
 *  `zones` from the other collections, but no write here sets either. */
final class TaxRules
{
    /** List the rules - `GET /admin/tax_rules`; `limit` is capped at 100, so page on `pagination.total`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTaxRules(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxRulesUrls::TAX_RULES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxRulePage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/tax_rules`; `200` with no body. */
    public static function headTaxRules(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxRulesUrls::TAX_RULES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a rule - `POST /admin/tax_rules`, `201`, wrapped in `tax_rule`; `name` is required and
     *  `description` is the only other field read.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createTaxRule(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TaxRulesUrls::TAX_RULES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxRule::class);
    }

    /** Retrieve one rule - `GET /admin/tax_rules/{tax_rule_id}`, the row under `tax_rule`; an unknown
     *  id is `404`. */
    public static function getTaxRule(WebCommanderClient $client, int|string $taxRuleId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TaxRulesUrls::TAX_RULE, pathParams: ['tax_rule_id' => $taxRuleId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxRule::class);
    }

    /** Ask whether a rule's path answers - `HEAD /admin/tax_rules/{tax_rule_id}`. */
    public static function headTaxRule(WebCommanderClient $client, int|string $taxRuleId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TaxRulesUrls::TAX_RULE, pathParams: ['tax_rule_id' => $taxRuleId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Update one rule - `PUT /admin/tax_rules/{tax_rule_id}`, wrapped, a merge; only `name` and
     *  `description` are read.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateTaxRule(WebCommanderClient $client, int|string $taxRuleId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(TaxRulesUrls::TAX_RULE, pathParams: ['tax_rule_id' => $taxRuleId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TaxRule::class);
    }

    /** Delete one rule - `DELETE /admin/tax_rules/{tax_rule_id}`, `204` and hard. */
    public static function deleteTaxRule(WebCommanderClient $client, int|string $taxRuleId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(TaxRulesUrls::TAX_RULE, pathParams: ['tax_rule_id' => $taxRuleId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
