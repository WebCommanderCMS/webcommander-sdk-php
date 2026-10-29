<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `security_code` block, the site lock; `code` reads back masked once set. */
final class SecurityCode extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?bool $enabled = null,
        public readonly ?bool $numberOnly = null,
    ) {
    }
}
