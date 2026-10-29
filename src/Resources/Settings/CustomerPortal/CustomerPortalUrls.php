<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal;

final class CustomerPortalUrls
{
    public const CUSTOMER_PORTAL = '/api/{api_version}/admin/settings/customer_portal';
    public const CUSTOMER_PORTAL_SECTION = '/api/{api_version}/admin/settings/customer_portal/{section}';

    /** The six values `{section}` takes, in the order the facade sends them.
     *  @var list<string> */
    public const CUSTOMER_PORTAL_SECTIONS = [
        'portal',
        'registration',
        'login',
        'sso',
        'profile_page',
        'registration_fields',
    ];

    /** The four sections `group_meta` marks writable, the only ones a `PATCH` may name; the other two
     *  still advertise `PATCH` in `Allow`.
     *  @var list<string> */
    public const CUSTOMER_PORTAL_WRITABLE_SECTIONS = [
        'portal',
        'registration',
        'login',
        'sso',
    ];
}
