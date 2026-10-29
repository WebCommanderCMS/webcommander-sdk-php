<?php

declare(strict_types=1);

namespace WebCommander\Resources\CommonSettings;

final class CommonSettingsUrls
{
    /** Not under `/admin`: the store-wide settings reader and writer, and the registration form. */
    public const SETTINGS = '/api/{api_version}/settings';
    public const CREATE_CUSTOMER_FIELDS = '/api/{api_version}/create-customer-fields';
}
