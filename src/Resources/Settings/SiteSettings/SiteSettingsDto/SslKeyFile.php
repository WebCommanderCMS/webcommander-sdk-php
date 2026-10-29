<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `ssl.key_file` block, what the store holds for the private key; the key is never returned. */
final class SslKeyFile extends Dto
{
    public function __construct(
        public readonly ?string $fileName = null,
        public readonly ?bool $uploaded = null,
    ) {
    }
}
