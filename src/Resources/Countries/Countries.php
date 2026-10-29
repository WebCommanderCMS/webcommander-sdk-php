<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Countries\CountriesDto\Country;
use WebCommander\Resources\Countries\CountriesDto\CountryPage;
use WebCommander\Resources\Countries\CountriesDto\CountryState;
use WebCommander\Resources\Countries\CountriesDto\CountryStatePage;

/** Country endpoints, under `/api/{api_version}/admin`. Read-only: `POST`, `PUT` and `PATCH` are `405`. */
final class Countries
{
    /** List the countries - `GET /admin/countries`, `id` ascending. `limit` is 1 to 100 or `all`,
     *  default 20; `code`, `name` and `id` match exactly, `search` a substring of `name` or `code`;
     *  `active`; `sort` `id`, `name` or `code` with `order`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listCountries(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CountriesUrls::COUNTRIES, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CountryPage::class);
    }

    /** Ask whether the collection answers - `HEAD /admin/countries`; no body, and the `ETag` the
     *  listing's first page carries. */
    public static function headCountries(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CountriesUrls::COUNTRIES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one country - `GET /admin/countries/{country_id}`. The slot takes the numeric `id`,
     *  the ISO `code` or the `name`, in any case. */
    public static function getCountry(WebCommanderClient $client, int|string $countryId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CountriesUrls::COUNTRY, pathParams: ['country_id' => $countryId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Country::class);
    }

    /** Ask whether one country's path answers - `HEAD /admin/countries/{country_id}`; no body, and
     *  the `ETag` its read carries. */
    public static function headCountry(WebCommanderClient $client, int|string $countryId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CountriesUrls::COUNTRY, pathParams: ['country_id' => $countryId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** List one country's states, beside the short parent country -
     *  `GET /admin/countries/{country_id}/states`; the same query names as `listCountries()`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listCountryStates(WebCommanderClient $client, int|string $countryId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CountriesUrls::COUNTRY_STATES, pathParams: ['country_id' => $countryId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CountryStatePage::class);
    }

    /** Ask whether one country's states answer - `HEAD /admin/countries/{country_id}/states`; no
     *  body, and the `ETag` the state listing's first page carries. */
    public static function headCountryStates(WebCommanderClient $client, int|string $countryId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CountriesUrls::COUNTRY_STATES, pathParams: ['country_id' => $countryId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one state of one country - `GET /admin/countries/{country_id}/states/{state_id}`;
     *  `$stateId` takes the state's `id`, `code` or `name`, in any case. */
    public static function getCountryState(WebCommanderClient $client, int|string $countryId, int|string $stateId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(CountriesUrls::COUNTRY_STATE, pathParams: ['country_id' => $countryId, 'state_id' => $stateId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CountryState::class);
    }

    /** Ask whether one state of one country answers -
     *  `HEAD /admin/countries/{country_id}/states/{state_id}`; no body, and the `ETag` its read
     *  carries. */
    public static function headCountryState(WebCommanderClient $client, int|string $countryId, int|string $stateId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', CountriesUrls::COUNTRY_STATE, pathParams: ['country_id' => $countryId, 'state_id' => $stateId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }
}
