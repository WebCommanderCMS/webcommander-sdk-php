<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `favicon` section; both fields are read-only. */
final class Favicon extends Dto
{
    public const ENVELOPE_KEY = 'favicon';

    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?MediaImage $image = null,
    ) {
    }
}
