<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `ssl.certificate_file` block: `SslKeyFile`'s two fields plus the certificate's subject and
 *  expiry. */
final class SslCertificateFile extends Dto
{
    public function __construct(
        public readonly ?string $expiresAt = null,
        public readonly ?string $fileName = null,
        public readonly ?string $subject = null,
        public readonly ?bool $uploaded = null,
    ) {
    }
}
