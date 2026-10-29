<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `smtp.authentication` block; `password` reads back as `***`. */
final class SmtpAuthentication extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $password = null,
        public readonly ?string $username = null,
    ) {
    }
}
