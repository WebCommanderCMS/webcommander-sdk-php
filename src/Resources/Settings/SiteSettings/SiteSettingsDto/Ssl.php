<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `ssl` block as read; a write sends `certificate_file_base64` and `key_file_base64` instead. */
final class Ssl extends Dto
{
    public function __construct(
        public readonly ?SslCertificateFile $certificateFile = null,
        public readonly ?SslKeyFile $keyFile = null,
    ) {
    }
}
