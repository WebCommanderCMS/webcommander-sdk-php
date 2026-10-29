<?php

declare(strict_types=1);

namespace WebCommander\Resources\Cities;

final class CitiesUrls
{
    /** Under `/app`, not `/admin`: the storefront address lookup. */
    public const CITIES = '/api/{api_version}/app/cities';
}
