<?php

declare(strict_types=1);

namespace WebCommander\Resources\Aliases;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Aliases\AliasesDto\Alias;
use WebCommander\Resources\Aliases\AliasesDto\AliasPage;

/** Domain alias endpoints. */
final class Aliases
{
    /** List the aliases - `GET /admin/aliases`, a created row listed last. Takes `limit` (capped at
     *  20), `offset`, `page` and `field_metadata`; `q` and `sort` are `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listAliases(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AliasesUrls::ALIASES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AliasPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/aliases`; `200` with no body. */
    public static function headAliases(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', AliasesUrls::ALIASES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create an alias - `POST /admin/aliases`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createAlias(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AliasesUrls::ALIASES, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Alias::class);
    }

    /** Delete an alias - `DELETE /admin/aliases/{alias_id}`. */
    public static function deleteAlias(WebCommanderClient $client, int|string $aliasId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AliasesUrls::ALIAS, pathParams: ['alias_id' => $aliasId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
