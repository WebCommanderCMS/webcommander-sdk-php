<?php

declare(strict_types=1);

namespace WebCommander\Resources\Countries;

final class CountriesUrls
{
    public const COUNTRIES = '/api/{api_version}/admin/countries';
    public const COUNTRY = '/api/{api_version}/admin/countries/{country_id}';
    public const COUNTRY_STATES = '/api/{api_version}/admin/countries/{country_id}/states';
    public const COUNTRY_STATE = '/api/{api_version}/admin/countries/{country_id}/states/{state_id}';
}
