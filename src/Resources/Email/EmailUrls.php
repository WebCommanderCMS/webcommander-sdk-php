<?php

declare(strict_types=1);

namespace WebCommander\Resources\Email;

final class EmailUrls
{
    public const EMAIL_SEND = '/api/{api_version}/admin/email/send';

    /** Names the plugin that owns the template `identifier`; a `plugin_uuid` body field is ignored. */
    public const PLUGIN_UUID_HEADER = 'plugin_uuid';
}
