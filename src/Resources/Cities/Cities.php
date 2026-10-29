<?php

declare(strict_types=1);

namespace WebCommander\Resources\Cities;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Cities\CitiesDto\CityPage;

/** City endpoints, under `/api/{api_version}/app`. Read-only: `POST`, `PUT`, `PATCH` and `DELETE` are `405`. */
final class Cities
{
    /** List the cities, by state, post code and name unless `sort` says otherwise - `GET /app/cities`.
     *  `limit` is the page size, 1 to 100 and 100 when absent; `offset` the start. `country` takes a
     *  country id or two-letter code, `state` a state id or, beside `country`, a state code;
     *  `post_code` matches exactly and `search` a substring of `name` in any case. `sort` is `state`,
     *  `name` or `post_code`, `order` `asc` or `desc`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listCities(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CitiesUrls::CITIES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CityPage::class);
    }

    /** Ask whether the listing answers - `HEAD /app/cities`; `200` with the listing's headers, its
     *  `ETag` among them, and no body. */
    public static function headCities(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CitiesUrls::CITIES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
